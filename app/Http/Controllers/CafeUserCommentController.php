<?php

namespace App\Http\Controllers;

use App\Models\CafeUserComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
//        dd($request->all());
        if ($request->hasFile('image')) {
            $file1 = $request->file('image')->getClientOriginalName();
            $filename1 = pathinfo($file1, PATHINFO_FILENAME);
            $extension1 = pathinfo($file1, PATHINFO_EXTENSION);
            $image = $filename1.'-'.time().'.'.$extension1;
            $request->file('image')->move(public_path('storage/images/cycle-track-user'), $image);

            if(!empty($request->previous_image)){
                if (File::exists(storage_path('/app/public/images/cycle-track-user/') . $request->previous_image)) {
                    File::delete(storage_path('/app/public/images/cycle-track-user/') . $request->previous_image);
                }
            }
        }else if(!empty($request->previous_image))
            $image = $request->previous_image;
        else
            $image = '';

        CafeUserComment::updateOrCreate([
            'user_id' => $request->user_id,
            'event_id'=> $request->cycle_comment_id,
        ],[
            'comment'=> $request->comment,
            'image'=> $image,
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
