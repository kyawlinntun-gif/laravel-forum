<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Discussion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use App\Http\Requests\CreateDiscussionRequest;
use App\Notifications\ReplyMarkedAsBestReply;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discussions.index', [
            'discussions' => Discussion::filterByChannel()->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request)
    {
        auth()->user()->discussions()->create([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title),
            'channel_id' => $request->channel_id,
        ]);

        $request->session()->flash('success', 'Discussions posted!');

        return redirect(url('/discussion'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return view('discussions.show', [
            'discussion' => $discussion
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Mark as best reply for Discussion.
     *
     * @return void
     */
    public function bestReply(Discussion $discussion, Reply $reply)
    {
        $discussion->markAsBestReply($reply);

        if (auth()->id() !== $discussion->author->id) {
            $discussion->author->notify(new ReplyMarkedAsBestReply($discussion));
        }

        session()->flash('success', 'Mark as best reply.');

        return redirect()->back();
    }
}
