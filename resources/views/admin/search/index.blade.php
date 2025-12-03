@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Search Results</h3>
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
                        <div class="text-tiny">Search</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <div class="show">
                            <div class="text-tiny">Search Results for: "{{ $query }}"</div>
                        </div>
                    </div>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        @if ($products->count() > 0)
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Sale Price</th>
                                        <th>SKU</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Featured</th>
                                        <th>Stock</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td class="pname">
                                                <div class="image">
                                                    <img src="{{ asset('uploads/products/thumbnails') }}/{{ $product->image }}"
                                                        alt="{{ $product->name }}" class="image">
                                                </div>
                                                <div class="name">
                                                    <a href="#" class="body-title-2">{{ $product->name }}</a>
                                                    <div class="text-tiny mt-3">{{ $product->slug }}</div>
                                                </div>
                                            </td>
                                            <td>${{ $product->regular_price }}</td>
                                            <td>${{ $product->sale_price }}</td>
                                            <td>{{ $product->SKU }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->brand->name }}</td>
                                            <td>{{ $product->featured == 0 ? 'No' : 'Yes' }}</td>
                                            <td>{{ $product->stock_status }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                <div class="list-icon-function">
                                                    <a
                                                        href="{{ route('admin.products.edit', ['product' => $product->id]) }}">
                                                        <div class="item edit">
                                                            <i class="icon-edit-3"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No products found matching your query.</p>
                        @endif
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
