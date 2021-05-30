@extends('layouts.app')

@section('content')

<div class="card my-5">

    @include('partials.discussion-header')

    <div class="card-body">
        <div class="text-center">
            <strong>{{ $discussion->title }}</strong>
        </div>
        <hr/>
        <div>
            {!! $discussion->content !!}
        </div>
    </div>

</div>

<div class="card">
    <div class="card">
        <div class="card-header">
            Add a reply
        </div>
        <div class="card-body">
            @auth
                <form action="{{ url('/discussions/' . $discussion->slug . '/replies') }}" method="POST">
                    @csrf
                    <input id="reply" type="hidden" name="reply">
                    <trix-editor input="reply"></trix-editor>
                    <buttton type="submit" class="btn btn-success mt-2">Add Reply</buttton>
                </form>
            @else
                <a href="{{ url('/login') }}" class="btn btn-info text-white">Sign in to add a reply</a>
            @endauth
        </div>
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/trix.min.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/trix.min.js') }}"></script>
@endsection
