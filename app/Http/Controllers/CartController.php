<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\SaleCodeMail;
use App\Mail\OrderMail;
use App\Models\Code;



class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] < $product->amount_available) {
                $cart[$id]['quantity']++;
            }
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function purchase(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        $discountCode = $request->input('discount_code');
        $discountAmount = 0;

        if ($discountCode) {
            $code = Code::where('code', $discountCode)->where('used', false)->first();

            if (!$code) {
                return redirect()->back()->with('warning', 'Invalid or already used discount code!');
            }

            $discountAmount = 5.00;
            $code->used = true;
            $code->save();
        }

        $totalAmount = 0;
        foreach ($cart as $id => &$item) {
            $item['total'] = $item['price'] * $item['quantity'];
            $totalAmount += $item['total'];
        }

        $totalAmount = max(0, $totalAmount - $discountAmount);

        $saleCode = strtoupper(bin2hex(random_bytes(4)));

        Code::create(['code' => $saleCode]);

        session()->put('totalAmount', $totalAmount);

        foreach ($cart as $id => $item) {
            $product = Product::findOrFail($id);
            $product->amount_available -= $item['quantity'];
            $product->save();
        }

        Mail::to($request->user()->email)->send(new OrderMail($cart, $totalAmount));

        Mail::to($request->user()->email)
            ->later(now()->addMinutes(15), new SaleCodeMail($saleCode));

        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Purchase successful! Your order details have been sent, and a sale code will arrive shortly.');
    }
}
