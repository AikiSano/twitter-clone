@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="d-inline-flex">
                    <div class="p-3 d-flex flex-column">
                        @if ($user->profile_image === null)
                            <img class="rounded-circle" src="{{ asset('default.png') }}" alt="プロフィール画像" width="100" height="100">
                        @else
                            <img src="{{ asset('storage/profile_image/' . $user->profile_image) }}" class="rounded-circle" width="100" height="100"> 
                        @endif
                        <div class="mt-3 d-flex flex-column">
                                <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
                                <span class="text-secondary">{{ $user->screen_name }}</span>
                        </div>
                    </div>
                    <div class="p-3 d-flex flex-column justify-content-between">
                        <div class="d-flex">
                            <div>
                                @if ($user->id === Auth::user()->id)
                                        <a href="{{ route('users.edit',$user->id, ['user' => $user->id]) }}" class="btn btn-primary">プロフィールを編集する</a>
                                @else
                                    @if (auth()->user()->isFollowing($user->id))
                                        <form action="{{ route('unfollow',$user->id,['user' => $user->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">フォロー解除</button>
                                        </form>
                                    @else
                                        <form action="{{ route('follow',$user->id, ['user' => $user->id]) }}" method="POST">
                                                {{ csrf_field() }}

                                                <button type="submit" class="btn btn-primary">フォローする</button>
                                        </form>
                                    @endif
                                    
                                    @if (auth()->user()->isFollowed($user->id))
                                        <span class="px-1 bg-secondary text-light">フォローされています</span>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="p-2 d-flex flex-column align-items-center">                             
                                <p class="font-weight-bold">ツイート数</p>   
                                <span>{{ $tweet_count }}</span>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                    <p class="font-weight-bold">フォロー数</p>
                                    <span>{{ $follow_count }}</span>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                    <p class="font-weight-bold">フォロワー数</p>
                                    <span>{{ $follower_count }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @if (isset($timelines))
        @foreach ($timelines as $timeline)
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header p-3 w-100 d-flex">
                        @if ($user->profile_image === null)
                            <img class="rounded-circle" src="{{ asset('default.png') }}" alt="プロフィール画像" width="70" height="70">
                        @else
                            <img src="{{ asset('storage/profile_image/' . $user->profile_image) }}" class="rounded-circle" width="70" height="70"> 
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
                            <p class="mb-0">{{ $timeline->text }} </p>
                        </div>
                </div>
            </div>
        @endforeach
    @endif
    </div>
</div>
@endsection



