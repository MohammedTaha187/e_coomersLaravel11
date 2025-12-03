@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">My Messages</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('user.accounte-nav')
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__content">
                        <div class="wg-box">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Reply</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $contact)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $contact->comment }}</td>
                                                <td>{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                                                <td>
                                                    @if ($contact->reply)
                                                        <span class="badge bg-success">Replied</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($contact->reply)
                                                        <p class="text-muted">{{ $contact->reply }}</p>
                                                        <small class="text-muted">Replied at:
                                                            {{ \Carbon\Carbon::parse($contact->replied_at)->format('Y-m-d H:i') }}</small>
                                                    @else
                                                        <span class="text-muted">Waiting for reply...</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
