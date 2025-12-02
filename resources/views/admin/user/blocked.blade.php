@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Blocked Users</h3>
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
                        <a href="{{ route('admin.users.blocked') }}">
                            <div class="text-tiny">Blocked Users</div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                    tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.users') }}"><i class="icon-users"></i>Active
                        Users</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Blocked By</th>
                                    <th>Reason</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td class="pname">
                                            <div class="image">
                                                <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}"
                                                    class="image">
                                            </div>
                                            <div class="name">
                                                <a href="#" class="body-title-2">{{ $user->name }}</a>
                                                <div class="text-tiny mt-3">
                                                    {{ $user->utype === 'ADM' ? 'Admin' : ($user->utype === 'OWN' ? 'Owner' : 'Customer') }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->blockedInfo->blocker->name ?? 'N/A' }}</td>
                                        <td>{{ $user->blockedInfo->reason ?? 'N/A' }}</td>
                                        <td>
                                            <div class="list-icon-function">
                                                <form action="{{ route('admin.users.unblock', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to unblock this user?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="item text-success" title="Unblock">
                                                        <i class="icon-check-circle"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
