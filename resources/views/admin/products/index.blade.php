@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>All Products</h3>
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
                            <div class="text-tiny">All Products</div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search" action="{{ route('admin.products.search') }}" method="GET">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="search"
                                    tabindex="2" value="{{ request()->query('search') }}" aria-required="true"
                                    required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.products.create') }}"><i
                            class="icon-plus"></i>Add new</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>SalePrice</th>
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
                                            <img src="{{ $product->image ? Storage::url($product->image) : asset('images/placeholder.png') }}"
                                                alt="{{ $product->name }}" class="image">
                                        </div>
                                        <div class="name">
                                            <div class="body-title-2">{{ $product->name }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>
                                        {{ $product->category->name ?? 'Uncategorized' }}
                                    </td>
                                    <td>
                                        {{ $product->brand->name ?? 'No Brand' }}
                                    </td>
                                    <td>{{ $product->featured ? 'Yes' : 'No' }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            <a href="{{ route('admin.products.show', $product->id) }}">
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </a>
                                            <a href="{{ route('admin.products.edit', $product->id) }}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                            <a href="{{ route('admin.products.destroy', $product->id) }}"
                                                class="item text-danger delete"
                                                onclick="event.preventDefault();
            if(confirm('Are you sure you want to delete this product?')) {
                document.getElementById('delete-product-{{ $product->id }}').submit();
            }">
                                                <i class="icon-trash-2"></i>
                                            </a>
                                            <form id="delete-product-{{ $product->id }}"
                                                action="{{ route('admin.categories.destroy', $product->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $products->links('pagination::bootstrap-4') }}

                </div>
            </div>
        </div>
    </div>
@endsection
