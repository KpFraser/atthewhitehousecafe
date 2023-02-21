<?php

namespace App\Http\Controllers;

use App\Models\CafeUserComment;
use Illuminate\Http\Request;

class CafeUserCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        CafeUserComment::updateOrCreate([
            'user_id' => $request->user_id,
            'cycle_comment_id'=> $request->cycle_comment_id,
        ],[
            'comment'=> $request->comment,
            'image'=> 'test',
        ]);
        return response()->success();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CafeUserComment  $cafeUserComment
     * @return \Illuminate\Http\Response
     */
    public function show(CafeUserComment $cafeUserComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CafeUserComment  $cafeUserComment
     * @return \Illuminate\Http\Response
     */
    public function edit(CafeUserComment $cafeUserComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CafeUserComment  $cafeUserComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CafeUserComment $cafeUserComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CafeUserComment  $cafeUserComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CafeUserComment $cafeUserComment)
    {
        //
    }
}
