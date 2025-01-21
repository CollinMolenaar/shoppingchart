@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>Products</h4>
        <a href="{{ route('cart.view') }}" class="btn btn-success">Go to Cart</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if($products->isEmpty())
                    <p>No products available.</p>
                    @else
                    @foreach ($products as $product)
                    <div class="product-item mb-3">
                        <strong>{{ $product->name }}</strong><br>
                        Price: ${{ number_format($product->price, 2) }}<br>
                        Amount Available: {{ $product->amount_available }}<br>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="btn btn-primary mt-2"
                                @if(isset(session('cart')[$product->id]) && session('cart')[$product->id]['quantity'] >= $product->amount_available)
                            disabled
                            @endif
                            >
                            Buy
                            </button>
                        </form>
                        <hr>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
