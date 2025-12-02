@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit User</h3>
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
                        <a href="{{ route('admin.users') }}">
                            <div class="text-tiny">Users</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit User</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.users.update', $user->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <fieldset class="name">
                        <div class="body-title">Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="User Name" name="name" tabindex="0"
                            value="{{ old('name', $user->name) }}" aria-required="true" required="" readonly>
                    </fieldset>
                    @error('name')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">Mobile <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Mobile Number" name="mobile" tabindex="0"
                            value="{{ old('mobile', $user->mobile) }}" aria-required="true" required="" readonly>
                    </fieldset>
                    @error('mobile')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">Email <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="email" placeholder="Email Address" name="email" tabindex="0"
                            value="{{ old('email', $user->email) }}" aria-required="true" required="" readonly>
                    </fieldset>
                    @error('email')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">User Type <span class="tf-color-1">*</span></div>
                        <div class="select flex-grow">
                            <select class="" name="utype">
                                <option value="USR" {{ $user->utype == 'USR' ? 'selected' : '' }}>Customer</option>
                                <option value="ADM" {{ $user->utype == 'ADM' ? 'selected' : '' }}>Admin</option>
                                <option value="OWN" {{ $user->utype == 'OWN' ? 'selected' : '' }}>Owner</option>
                            </select>
                        </div>
                    </fieldset>
                    @error('utype')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit" name="submit" value="save">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
