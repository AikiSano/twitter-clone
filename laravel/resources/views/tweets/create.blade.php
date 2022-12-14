@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ツイート新規作成</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tweets.store') }}">
                        @csrf

                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 w-100 d-flex">
                                @if ($user->profile_image === null)
                                    <img class="rounded-circle" src="{{ asset('default.png') }}" alt="プロフィール画像" width="70" height="70">
                                @else
                                    <img src="{{ asset('storage/profile_image/' . $user->profile_image) }}" class="rounded-circle" width="70" height="70"> 
                                @endif
                                <div class="ml-2 d-flex flex-column">
                                    <p class="mb-0">{{ $user->name }}</p>
                                    <p class="mb-0">{{ $user->screen_name }}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('text') }}</textarea>

                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <p class="mb-4 text-danger">140文字以内</p>
                                <button type="submit" class="btn btn-primary">
                                    ツイートする
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
