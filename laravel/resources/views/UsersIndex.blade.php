@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ユーザ一覧') }}</div>
                    @foreach($users as $user)
                    <div class="card">
                        <div class="card-header p-3 w-100 d-flex">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">ユーザネーム:{{ $user->name }}</p>
                                <p class="mb-0">メールアドレス:{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
