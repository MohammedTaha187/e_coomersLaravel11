@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Wishlist</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('user.accounte-nav')
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__wishlist">
                        @if (Session::has('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="products-grid row row-cols-2 row-cols-lg-3" id="products-grid">
                            @forelse ($wishlistItems as $item)
                                <div class="product-card-wrapper">
                                    <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                                        <div class="pc__img-wrapper">
                                            <div class="swiper-container background-img js-swiper-slider"
                                                data-settings='{"resizeObserver": true}'>
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a
                                                            href="{{ route('user.shop.product-details', ['product_slug' => $item->product->slug]) }}">
                                                            <img loading="lazy"
                                                                src="{{ $item->product->image ? Storage::url($item->product->image) : asset('images/placeholder.png') }}"
                                                                width="330" height="400"
                                                                alt="{{ $item->product->name }}" class="pc__img">
                                                        </a>
                                                    </div>
                                                    @foreach ($item->product->galleries as $gallery)
                                                        <div class="swiper-slide">
                                                            <a href="{{ route('user.shop.product-details', ['product_slug' => $item->product->slug]) }}">
                                                                <img loading="lazy"
                                                                    src="{{ Storage::url($gallery->image) }}"
                                                                    width="330" height="400"
                                                                    alt="{{ $item->product->name }}" class="pc__img">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <span class="pc__img-prev"><svg width="7" height="11"
                                                        viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_prev_sm" />
                                                    </svg></span>
                                                <span class="pc__img-next"><svg width="7" height="11"
                                                        viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_next_sm" />
                                                    </svg></span>
                                            </div>
                                            <form action="{{ route('user.wishlist.destroy', ['rowId' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-remove-from-wishlist"
                                                    title="Remove from Wishlist">
                                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_close" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="pc__info position-relative">
                                            <p class="pc__category">{{ $item->product->category->name }}</p>
                                            <h6 class="pc__title"><a
                                                    href="{{ route('user.shop.product-details', ['product_slug' => $item->product->slug]) }}">{{ $item->product->name }}</a>
                                            </h6>
                                            <div class="product-card__price d-flex">
                                                @if ($item->product->sale_price)
                                                    <span
                                                        class="money price price-old">${{ $item->product->regular_price }}</span>
                                                    <span
                                                        class="money price price-sale">${{ $item->product->sale_price }}</span>
                                                @else
                                                    <span class="money price">${{ $item->product->regular_price }}</span>
                                                @endif
                                            </div>

                                            <form
                                                action="{{ route('user.wishlist.move.to.cart', ['rowId' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0"
                                                    title="Move To Cart">
                                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_heart" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p>Your wishlist is empty.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
