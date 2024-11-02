@extends('layouts.app')
@section('content')
    <div class="container">
        @include('shared.alerts')
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    @if (auth()->check() && (auth()->user()->role_id == 1 || auth()->user()->role_id == 2))
                        <th scope="col">Change Role</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="{{ auth()->check() && auth()->user()->id == $user->id ? 'table-active' : '' }}">
                        <td scope="col">{{ $user->id }}</td>
                        <td scope="col">{{ $user->name }}</td>
                        <td scope="col">{{ $user->email }}</td>
                        <td scope="col">
                            @php
                                $badgeBg = '';
                                switch ($user->role_id) {
                                    case 1:
                                        $badgeBg = 'text-bg-primary';
                                        break;
                                    case 2:
                                        $badgeBg = 'text-bg-success';
                                        break;
                                    case 3:
                                        $badgeBg = 'text-bg-secondary';
                                }
                            @endphp
                            <span class="badge {{ $badgeBg }}">{{ $user->role->name }}</span>
                        </td>
                        @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                            <td scope="col">
                                <div class="d-flex gap-2">
                                    @if ((auth()->user()->role_id == 1 && $user->role_id != 1))
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Change Role
                                            </button>
                                            <ul class="dropdown-menu">
                                                @foreach ([
            1 => 'Admin',
            2 => 'Manager',
            3 => 'User',
        ] as $roleId => $roleName)
                                                    <form method="POST"
                                                        action="{{ route('changeRole', ['id' => $user->id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="role_id" value="{{ $roleId }}">
                                                        <button type="submit"
                                                            class="dropdown-item">{{ $roleName }}</button>
                                                    </form>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if ((auth()->user()->role_id == 1 && $user->role_id != 1) || 
                                        (auth()->user()->role_id == 2 && $user->role_id == 3))
                                        <form action="{{ $user->ban == 0 ? route('ban', ['id' => $user->id]) : route('unban', ['id' => $user->id]) }}" method="post">
                                            @csrf
                                            <button name="ban" type="submit" class="btn {{ $user->ban == 0 ? 'btn-outline-warning' : 'btn-warning' }}">
                                                {{ $user->ban == 0 ? 'Ban' : 'Unban' }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
