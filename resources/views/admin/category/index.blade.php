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
                <h3>Categories</h3>
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
                        <a href="{{ route('admin.categories') }}">
                            <div class="text-tiny">Categories</div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search" action="{{ route('admin.categories.search') }}" method="GET">
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
                    <a class="tf-button style-1 w208" href="{{ route('admin.categories.create') }}"><i
                            class="icon-plus"></i>Add new</a>
                </div>
                <div class="wg-table table-all-user">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Products</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorys as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td class="pname">
                                        <div class="image">
                                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                                class="image">
                                        </div>
                                        <div class="name">
                                            <a href="#" class="body-title-2">{{ $category->name }}</a>
                                        </div>
                                    </td>
                                    <td>{{ $category->slug }}</td>
                                    <td><a href="#" target="_blank">{{ $category->products_count ?? 0 }}</a></td>
                                    <td>
                                        <div class="list-icon-function">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                            <a href="{{ route('admin.categories.destroy', $category->id) }}"
                                                class="item text-danger delete"
                                                onclick="event.preventDefault();
            if(confirm('Are you sure you want to delete this category?')) {
                document.getElementById('delete-category-{{ $category->id }}').submit();
            }">
                                                <i class="icon-trash-2"></i>
                                            </a>
                                            <form id="delete-category-{{ $category->id }}"
                                                action="{{ route('admin.categories.destroy', $category->id) }}"
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
                    {{ $categorys->links('pagination::bootstrap-5') }}

                </div>
            </div>
        </div>
    </div>
@endsection
