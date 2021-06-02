@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Notifications</div>

    <div class="card-body">
        <ul class="list-group">
            @foreach ($notifications as $notification)
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                        A new reply was added to your discussion <strong>{{ $notification->data['discussion']['title'] }}</strong>
                    </div>
                    <div>
                        <a href="{{ url('/discussions/' . $notification->data['discussion']['slug']) }}" class="btn btn-primary btn-sm">View discussion</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
