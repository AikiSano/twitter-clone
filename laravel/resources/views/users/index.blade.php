@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($users as $user)
                    <div class="card">
                        <div class="card-header p-3 bg-white text-dark d-flex">
                            @if ($user->profile_image === null)
                                <img class="rounded-circle" src="{{ asset('default.png') }}" alt="プロフィール画像" width="70" height="70">
                            @else
                                <img src="{{ asset('storage/profile_image/' .$user->profile_image ) }}" class="rounded-circle" width="70" height="70"> 
                            @endif
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-1"><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a> </p>
                                <p class="mb-1">{{ $user->screen_name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
@endsection

<!-- .$user->profile_image -->