<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Requests\CreateReplyRequest;
use App\Notifications\NewReplyAdded;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    
    public function store(Request $request, Discussion $discussion)
    {
        auth()->user()->replies()->create([
            'content' => $request->content,
            'discussion_id' => $discussion->id
        ]);

        if (auth()->id() !== $discussion->author->id) {
            $discussion->author->notify(new NewReplyAdded($discussion));
        }

        session()->flash('success', 'Reply added.');

        return redirect()->back();
    }
}
