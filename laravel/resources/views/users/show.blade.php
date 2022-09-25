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
    <a href="{{ route('users') }}" class="alert-link">戻る</a><br />
</div>
@endsection