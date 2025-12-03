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
                <h3>Settings</h3>
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
                        <div class="text-tiny">Settings</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="col-lg-12">
                    <div class="page-content my-account__edit">
                        <div class="my-account__edit-form">
                            <form name="settings_form" action="{{ route('admin.settings.store') }}" method="POST"
                                class="form-new-product form-style-1 needs-validation" novalidate="">
                                @csrf
                                <fieldset class="name">
                                    <div class="body-title">Address <span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="text" placeholder="Address" name="address"
                                        tabindex="0" value="{{ $setting->address ?? old('address') }}"
                                        aria-required="true" required="">
                                </fieldset>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />

                                <fieldset class="name">
                                    <div class="body-title">Email <span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="email" placeholder="Email" name="email"
                                        tabindex="0" value="{{ $setting->email ?? old('email') }}" aria-required="true"
                                        required="">
                                </fieldset>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                <fieldset class="name">
                                    <div class="body-title">Phone <span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="text" placeholder="Phone" name="phone"
                                        tabindex="0" value="{{ $setting->phone ?? old('phone') }}" aria-required="true"
                                        required="">
                                </fieldset>
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />

                                <fieldset class="name">
                                    <div class="body-title">Facebook Link <span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="text" placeholder="Facebook Link" name="facebook"
                                        tabindex="0" value="{{ $setting->facebook ?? old('facebook') }}"
                                        aria-required="true" required="">
                                </fieldset>
                                <x-input-error :messages="$errors->get('facebook')" class="mt-2" />

                                <fieldset class="name">
                                    <div class="body-title">Twitter Link <span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="text" placeholder="Twitter Link" name="twitter"
                                        tabindex="0" value="{{ $setting->twitter ?? old('twitter') }}"
                                        aria-required="true" required="">
                                </fieldset>
                                <x-input-error :messages="$errors->get('twitter')" class="mt-2" />
                                <fieldset class="name">
                                    <div class="body-title">Instagram Link <span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="text" placeholder="Instagram Link" name="instagram"
                                        tabindex="0" value="{{ $setting->instagram ?? old('instagram') }}"
                                        aria-required="true" required="">
                                </fieldset>
                                <x-input-error :messages="$errors->get('instagram')" class="mt-2" />

                                <fieldset class="name">
                                    <div class="body-title">Youtube Link <span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="text" placeholder="Youtube Link" name="youtube"
                                        tabindex="0" value="{{ $setting->youtube ?? old('youtube') }}"
                                        aria-required="true" required="">
                                </fieldset>
                                <x-input-error :messages="$errors->get('youtube')" class="mt-2" />
                                <fieldset class="name">
                                    <div class="body-title">Pinterest Link <span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="text" placeholder="Pinterest Link"
                                        name="pinterest" tabindex="0"
                                        value="{{ $setting->pinterest ?? old('pinterest') }}" aria-required="true"
                                        required="">
                                </fieldset>
                                <x-input-error :messages="$errors->get('pinterest')" class="mt-2" />

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <button type="submit" class="btn btn-primary tf-button w208">Save
                                                Settings</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
