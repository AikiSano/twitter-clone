@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3 text-right">
            <a href="{{ route('users') }}">ユーザ一覧 <i class="fas fa-users" class="fa-fw"></i> </a>
        </div>
        @if (isset($timelines))
            @foreach ($timelines as $timeline)
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header p-3 w-100 d-flex">
                        @if ($timeline->user->profile_image === null)
                            <img class="rounded-circle" src="{{ asset('default.png') }}" alt="プロフィール画像" width="70" height="70">
                        @else
                            <img src="{{ asset('storage/profile_image/' .$timeline->user->profile_image) }}" class="rounded-circle" width="70" height="70"> 
                        @endif
                            <div class="ml-2 d-flex flex-column flex-grow-1">
                                <p class="mb-0">{{ $timeline->user->name }}</p> <p class="mb-0"> {{ $timeline->user->screen_name }}</p>
                                <a href="{{ url('users/' .$timeline->user->id) }}" class="text-secondary">{{ $timeline->user->user_name }}</a>
                            </div>
                        <div class="d-flex justify-content-end flex-grow-1">
                            <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                        <div class="card-body">
                            <p class="mb-1"><a href="{{ route('tweets.show', $timeline->id ) }}">{{ $timeline->text }}</a> </p>
                        
                        </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
