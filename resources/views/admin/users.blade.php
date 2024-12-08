@extends('layouts.app')

@section('content')
    <h1>User Management</h1>
    <div class="users">
        @foreach($users as $user)
            <div class="user">
                <h3>{{ $user->name }} ({{ $user->role }})</h3>
                <p>Email: {{ $user->email }}</p>
                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete User</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
