@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Product Details</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.products') }}">
                            <div class="text-tiny">Products</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">{{ $product->name }}</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-images">
                            <div class="main-image mb-4">
                                <img src="{{ $product->image ? Storage::url($product->image) : asset('images/placeholder.png') }}"
                                    alt="{{ $product->name }}" class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
                            </div>
                            @if($product->galleries->count() > 0)
                                <div class="gallery-images d-flex gap-2 flex-wrap">
                                    @foreach($product->galleries as $gallery)
                                        <div class="gallery-item" style="width: 100px; height: 100px;">
                                            <img src="{{ Storage::url($gallery->image) }}" alt="Gallery Image"
                                                class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-info">
                            <h2 class="mb-3">{{ $product->name }}</h2>
                            <p class="text-muted mb-4">Slug: {{ $product->slug }}</p>

                            <div class="price mb-4">
                                @if($product->sale_price)
                                    <span class="h4 text-danger me-2">${{ $product->sale_price }}</span>
                                    <span class="text-muted text-decoration-line-through">${{ $product->price }}</span>
                                @else
                                    <span class="h4">${{ $product->price }}</span>
                                @endif
                            </div>

                            <div class="meta-info mb-4">
                                <p><strong>SKU:</strong> {{ $product->sku }}</p>
                                <p><strong>Category:</strong> {{ $product->category->name ?? 'Uncategorized' }}</p>
                                <p><strong>Brand:</strong> {{ $product->brand->name ?? 'No Brand' }}</p>
                                <p><strong>Stock Status:</strong> 
                                    <span class="badge {{ $product->stock_status == 'instock' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $product->stock_status }}
                                    </span>
                                </p>
                                <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
                                <p><strong>Featured:</strong> {{ $product->featured ? 'Yes' : 'No' }}</p>
                            </div>

                            <div class="short-description mb-4">
                                <h5>Short Description</h5>
                                <p>{{ $product->short_description }}</p>
                            </div>

                            <div class="description">
                                <h5>Description</h5>
                                <div class="content">
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Edit Product</a>
                        <a href="{{ route('admin.products') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
