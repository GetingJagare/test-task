@extends('layouts.basic')

@section('title', 'All Users')

@section('content')
    <table class="table m-auto" style="max-width: 1000px;">
        <thead>
          <tr>
            <th>Avatar</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Role</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
              <tr>
                <td>
                  @if ($user->info && $user->info->avatar)
                      <img src="/images/{{$user->info->avatar->path}}" alt="No avatar" 
                          style="max-width: 100px;"/>
                  @endif
                </th>
                <td>
                  {{ $user->email }}
                  @if (!$user->email_verified_at)
                      &nbsp;(Not Verified)
                  @endif
                </td>
                <td>{{ $user->info ? $user->info->first_name : '' }}</th>
                <td>{{ $user->info ? $user->info->first_name : '' }}</td>
                <td>{{ $user->role->name }}</td>
                <td>
                    <div class="d-flex justify-content-end">
                        @if ($user->role_id !== 1 && $user->email_verified_at)
                        <form method="POST" action="users/set-admin">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}" />
                            <button type="submit" class="btn btn-success">Appoint as Admin</button>
                        </form>
                        @endif
                        @if (auth()->user()->id !== $user->id)
                          <form method="POST" action="users/delete" class="ms-3">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}" />
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        @endif
                    </div>
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
@endsection