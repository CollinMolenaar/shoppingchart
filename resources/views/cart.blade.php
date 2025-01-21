@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Shopping Cart</h4>
        <a href="{{ url('/home') }}" class="btn btn-primary">Back to Shopping</a>
    </div>
    @if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
    @endif
    @if (empty($cart))
    <p>Your cart is empty.</p>
    @else
    <form action="{{ route('cart.purchase') }}" method="POST">
        @csrf
        <label for="discount_code">Enter Discount Code:</label>
        <input type="text" name="discount_code" id="discount_code" />
    </form>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @php $grandTotal = 0; @endphp
        @foreach ($cart as $id => $item)
        @php $itemTotal = $item['price'] * $item['quantity']; @endphp
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>${{ number_format($item['price'], 2) }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>${{ number_format($itemTotal, 2) }}</td>
        </tr>
        @php $grandTotal += $itemTotal; @endphp
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3" class="text-end"><strong>Total:</strong></td>
            <td><strong>${{ number_format($grandTotal, 2) }}</strong></td>
        </tr>
        </tfoot>
    </table>
    @endif
    @if (!empty($cart))
    <form action="{{ route('cart.purchase') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Purchase</button>
    </form>
    @endif
</div>
@endsection
