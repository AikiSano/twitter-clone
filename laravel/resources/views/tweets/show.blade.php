@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-header p-3 w-100 d-flex">
                    @if ($tweet->user->profile_image === null)
                        <img class="rounded-circle" src="{{ asset('default.png') }}" alt="プロフィール画像" width="70" height="70">
                    @else
                        <img src="{{ asset('storage/profile_image/' . $tweet->user->profile_image) }}" class="rounded-circle" width="70" height="70"> 
                    @endif
                    <div class="ml-2 d-flex flex-column">
                        <p class="mb-0">{{ $tweet->user->name }}</p>
                        <p class="mb-0"> {{ $tweet->user->screen_name }}</p>       
                    </div>
                    <div class="d-flex justify-content-end flex-grow-1">
                        <p class="mb-0 text-secondary">{{ $tweet->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
                    <div class="card-body">
                        {!! nl2br(e($tweet->text)) !!}
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection