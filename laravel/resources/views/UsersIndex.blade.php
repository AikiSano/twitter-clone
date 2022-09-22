@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ユーザ一覧') }}</div>
                    @foreach($users as $user)
                        <div class="card-body">
                        <table class="table">
                            <tbody>
                                <th scope="row">{{  $user->name  }}</th>
                            </tbody>
                        </table>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
