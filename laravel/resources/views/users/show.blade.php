@extends('layouts.app')

@section('content')
<div class="container">
    @if(!empty($user))
    <table class="table table-striped table-hover">
    <thead>
    <tr>
        <th></th>
        <th>ID</th>
        <th>名前</th>
        <th>メールアドレス</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <tr>
        <!-- <td>
            <div>
            @if(!empty($user->thumbnail))
            <img src="/storage/user/{{ $user->thumbnail }}" class="thumbnail">
            @endif
            </div>
        </td> -->
        <td></td>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
        </td>
        </tr>
    </tbody>
    </table>
    @if (auth()->user()->isFollowed($user->id))
        <div class="px-2">
            <span class="px-1 bg-secondary text-light">フォローされています</span>
        </div>
    @endif
    <div class="d-flex justify-content-end flex-grow-1">
    @if ($user->id === Auth::user()->id)
        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary">プロフィールを編集する</a>
    @endif
        @if (auth()->user()->isFollowing($user->id))
            <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type="submit" class="btn btn-danger">フォロー解除</button>
            </form>
        @else
            <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                {{ csrf_field() }}

                <button type="submit" class="btn btn-primary">フォローする</button>
            </form>
        @endif
@endif

    <a href="{{ route('users') }}" class="alert-link">戻る</a><br/>

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

@if (isset($timelines))
        @foreach ($timelines as $timeline)
        <div class="row justify-content-center">
            <div class="d-inline-flex">
                <div class="col-md-8 mb-3">
                    <div class="card">
                        <div class="card-header p-3 w-100 d-flex">
                            {{-- <img src="{{  }}" class="rounded-circle" width="50" height="50"> --}}
                            <div class="ml-2 d-flex flex-column flex-grow-1">
                                <p class="mb-0">{{ $timeline->user->name }}</p>
                                <a href="{{ url('users/' .$timeline->user->id) }}" class="text-secondary">{{ $timeline->user->user_name }}</a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $timeline->text }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>

@endsection
