@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Account Details</h3>
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
                        <div class="text-tiny">Account</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="col-lg-12">
                    <div class="page-content my-account__edit">
                        <div class="my-account__edit-form">
                            <form name="account_edit_form" action="{{ route('admin.profile.store') }}" method="POST"
                                enctype="multipart/form-data" class="form-new-product form-style-1 needs-validation"
                                novalidate="">
                                @csrf
                                <fieldset class="name">
                                    <div class="body-title">Name <span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="text" placeholder="Full Name" name="name"
                                        tabindex="0" value="{{ $user->name }}" aria-required="true" required="">
                                </fieldset>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                <fieldset>
                                    <div class="body-title">Upload images <span class="tf-color-1">*</span></div>
                                    <div class="upload-image flex-grow">
                                        <div class="item" id="imgpreview" style="display:none">
                                            <img src="#" class="effect8" alt="Preview">
                                        </div>
                                        <div id="upload-file" class="item up-load">
                                            <label class="uploadfile" for="myFile">
                                                <span class="icon">
                                                    <i class="icon-upload-cloud"></i>
                                                </span>
                                                <span class="body-text">Drop your images here or select <span
                                                        class="tf-color">click to browse</span></span>
                                                <input type="file" id="myFile" name="image" accept="image/*">
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />

                                <fieldset class="name">
                                    <div class="body-title">Email Address <span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="email" placeholder="Email Address" name="email"
                                        tabindex="0" value="{{ $user->email }}" aria-required="true" required="">
                                </fieldset>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <h5 class="text-uppercase mb-0">Password Change</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <fieldset class="name">
                                            <div class="body-title pb-3">Old Password</div>
                                            <input class="flex-grow" type="password" placeholder="Old Password"
                                                name="old_password" tabindex="0" value="" aria-required="true">
                                        </fieldset>
                                        <x-input-error :messages="$errors->get('old_password')" class="mt-2" />

                                    </div>
                                    <div class="col-md-12">
                                        <fieldset class="name">
                                            <div class="body-title pb-3">New Password</div>
                                            <input class="flex-grow" type="password" placeholder="New Password"
                                                name="new_password" tabindex="0" value="" aria-required="true">
                                        </fieldset>
                                        <x-input-error :messages="$errors->get('new_password')" class="mt-2" />

                                    </div>
                                    <div class="col-md-12">
                                        <fieldset class="name">
                                            <div class="body-title pb-3">Confirm New Password</div>
                                            <input class="flex-grow" type="password" placeholder="Confirm New Password"
                                                name="new_password_confirmation" tabindex="0" value=""
                                                aria-required="true">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <button type="submit" class="btn btn-primary tf-button w208">Save
                                                Changes</button>
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

@push('scripts')
    <script>
        $(function() {
            $("#myFile").on("change", function(e) {
                const [file] = this.files;
                if (file) {
                    $("#imgpreview img").attr('src', URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });
        });
    </script>
@endpush
