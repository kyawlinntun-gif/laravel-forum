<div class="card-header">
    <div class="d-flex justify-content-between">
        <div>
            <img src="{{ Gravatar::src($discussion->author->email) }}" style="width: 40px; height: 40px; border-radius: 50%;" />
            <span class="mx-2 font-weight-bold">{{ $discussion->author->name }}</span>
        </div>
        <div>
            <a href="{{ url('/discussions/' . $discussion->slug) }}" class="btn btn-success">View</a>
        </div>
    </div>
</div>
