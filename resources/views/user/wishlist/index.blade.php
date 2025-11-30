@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Wishlist</h2>
            <div class="shopping-cart">
                <div class="cart-table__wrapper">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th></th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlistItems as $item)
                                <tr>
                                    <td>
                                        <div class="shopping-cart__product-item">
                                            <img loading="lazy"
                                                src="{{ $item->product->image ? Storage::url($item->product->image) : asset('images/placeholder.png') }}"
                                                width="120" height="120" alt="{{ $item->product->name }}" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shopping-cart__product-item__detail">
                                            <h4>{{ $item->product->name }}</h4>
                                            {{-- <ul class="shopping-cart__product-item__options">
                      <li>Color: Yellow</li>
                      <li>Size: L</li>
                    </ul> --}}
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="shopping-cart__product-price">${{ $item->product->sale_price ?? $item->product->regular_price }}</span>
                                    </td>
                                    <td>
                                        {{-- Quantity is not relevant for wishlist --}}
                                        1
                                    </td>
                                    <td>
                                        <span
                                            class="shopping-cart__subtotal">${{ $item->product->sale_price ?? $item->product->regular_price }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <form method="POST"
                                                action="{{ route('user.wishlist.move.to.cart', ['rowId' => $item->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary me-3">Move to
                                                    Cart</button>
                                            </form>
                                            <form method="POST"
                                                action="{{ route('user.wishlist.destroy', ['rowId' => $item->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="javascript:void(0)" onclick="this.closest('form').submit()"
                                                    class="remove-cart">
                                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                                        <path
                                                            d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                                    </svg>
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="cart-table-footer">
                        <form action="#" class="position-relative bg-body">
                            <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code">
                            <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                                value="APPLY COUPON">
                        </form>
                        
                    </div>
                </div>
                <div class="shopping-cart__totals-wrapper">
                    <div class="sticky-content">
                        <div class="shopping-cart__totals">
                            <h3>Wishlist Actions</h3>
                            <form method="POST" action="{{ route('user.wishlist.empty') }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light w-100">EMPTY WISHLIST</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
