@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Block User</h3>
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
                        <div class="text-tiny">Block User</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.users.store-block', $user->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <fieldset class="name">
                        <div class="body-title">User Name</div>
                        <input class="flex-grow" type="text" value="{{ $user->name }}" disabled>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Reason for Blocking <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10" name="reason" placeholder="Enter reason here..." tabindex="0" aria-required="true"
                            required=""></textarea>
                    </fieldset>
                    @error('reason')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Block User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
