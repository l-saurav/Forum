<?php

namespace App\Http\Controllers;

use App\Models\discussion;
use App\Http\Requests\StorediscussionRequest;
use App\Http\Requests\UpdatediscussionRequest;
use Illuminate\Support\Facades\URL;
use App\Models\Vote;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discussion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorediscussionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorediscussionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function show(discussion $discussion)
    {
        return view('discussion.show', [
            'discussion' => $discussion,
            'votesCount' => $discussion->votes()->count(),
            'backUrl' => url()->previous() !== url()->current() ? url()->previous() : route('discussion.index'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(discussion $discussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatediscussionRequest  $request
     * @param  \App\Models\discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatediscussionRequest $request, discussion $discussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(discussion $discussion)
    {
        //
    }
}
