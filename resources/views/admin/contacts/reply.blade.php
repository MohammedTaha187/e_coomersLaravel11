@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Reply to Message</h3>
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
                        <a href="{{ route('admin.contacts') }}">
                            <div class="text-tiny">Inbox</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Reply</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <form class="form-new-product form-style-1"
                    action="{{ route('admin.contacts.reply.update', ['id' => $contact->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <fieldset class="name">
                        <div class="body-title">Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Name" name="name" tabindex="0"
                            value="{{ $contact->name }}" aria-required="true" required="" disabled>
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Email <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Email" name="email" tabindex="0"
                            value="{{ $contact->email }}" aria-required="true" required="" disabled>
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Phone <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Phone" name="phone" tabindex="0"
                            value="{{ $contact->phone }}" aria-required="true" required="" disabled>
                    </fieldset>
                    <fieldset class="description">
                        <div class="body-title mb-10">Message <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10" name="comment" placeholder="Message" tabindex="0" aria-required="true" required=""
                            disabled>{{ $contact->comment }}</textarea>
                    </fieldset>
                    <fieldset class="description">
                        <div class="body-title mb-10">Reply <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10" name="reply" placeholder="Type your reply here..." tabindex="0" aria-required="true"
                            required="">{{ $contact->reply }}</textarea>
                    </fieldset>
                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Send Reply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
