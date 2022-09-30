@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9"> 

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
            </div>
        </div>
    </div>
</div>
@endsection
