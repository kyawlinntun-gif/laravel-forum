@extends('layouts.app')

@section('content')
<div class="clearfix mb-2">
    <a href="{{ url('/discussion/create') }}" class="btn btn-primary float-right">Add Discussion</a>
</div>
<div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        {{ __('You are logged in!') }}
    </div>
</div>
@endsection
