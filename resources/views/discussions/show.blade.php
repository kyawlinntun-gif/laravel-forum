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

        <div class="card text-white bg-success mt-5">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img src="{{ Gravatar::src($discussion->bestReply->owner->email) }}" alt="{{ $discussion->bestReply->owner->email }}" style="width: 40px; height: 40px; border-radius: 50%;">
                        <span class="ml-2">{{ $discussion->bestReply->owner->name }}</span>
                    </div>
                    <div>
                        BEST REPLY
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!! $discussion->bestReply->content !!}
            </div>
          </div>

    </div>

</div>

@foreach ($discussion->replies()->paginate(3) as $reply)    
    <div class="card my-5">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <img src="{{ Gravatar::src($reply->owner->email) }}" style="width: 40px; height: 40px; border-radius: 50%;" alt="{{ $reply->owner->email }}" />
                    <span class="mx-2 font-weight-bold">{{ $reply->owner->email }}</span>
                </div>
                <div>
                    @if (auth()->user()->id === $discussion->user_id)
                    <form action="{{ url("/discussions/$discussion->slug/replies/$reply->id/mark-as-best-reply") }}" method="POST">
                        @csrf
                        <button class="btn btn-primary">Mark as best reply</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! $reply->content !!}
        </div>
    </div>
    
@endforeach
    {{ $discussion->replies()->paginate(3)->links() }}


<div class="card my-5">
    <div class="card">
        <div class="card-header">
            Add a reply
        </div>
        <div class="card-body">
            @auth
                <form action="{{ url('/discussions/' . $discussion->slug . '/replies') }}" method="POST">
                    @csrf
                    <input id="content" type="hidden" name="content">
                    <trix-editor input="content"></trix-editor>
                    <button type="submit" class="btn btn-success mt-2">Add Reply</button>
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
