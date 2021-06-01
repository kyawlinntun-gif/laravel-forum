<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Requests\CreateReplyRequest;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    
    public function store(Request $request, Discussion $discussion)
    {
        auth()->user()->replies()->create([
            'content' => $request->content,
            'discussion_id' => $discussion->id
        ]);

        session()->flash('success', 'Reply added.');

        return redirect()->back();
    }
}
