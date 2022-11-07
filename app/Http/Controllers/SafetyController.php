<?php

namespace App\Http\Controllers;

use App\Models\Safety;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SafetyController extends Controller
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
        if ($request->hasFile('document')) {
            $file1 = $request->file('document')->getClientOriginalName();
            $filename1 = pathinfo($file1, PATHINFO_FILENAME);
            $extension1 = pathinfo($file1, PATHINFO_EXTENSION);
            $document = $filename1.'-'.time().'.'.$extension1;
            $document_path = $request->file('document')->move(public_path('storage/insuranceDocument'), $document);

            if (!empty($request->document_name) && !empty($document_path)){
                if(File::exists(storage_path('/app/public/insuranceDocument/').$request->document_name)){
                    File::delete(storage_path('/app/public/insuranceDocument/').$request->document_name);
                }
            }
        }else{
            $document = $request->document_name;
            $filename1 = $request->document_name;
        }
        Safety::updateOrCreate([
            'user_id'=> auth()->user()->id,
        ],[
            'document' => $document,
            'date' => !!$request->date ? $request->date: '',
            'text1' => $request->text1,
            'text2' => $request->text2,
            'text3' => $request->text3,
            'document_path' => $filename1,
        ]);
        return response()->success();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Safety  $safety
     * @return \Illuminate\Http\Response
     */
    public function show(Safety $safety)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Safety  $safety
     * @return \Illuminate\Http\Response
     */
    public function edit(Safety $safety)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Safety  $safety
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Safety $safety)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Safety  $safety
     * @return \Illuminate\Http\Response
     */
    public function destroy(Safety $safety)
    {
        //
    }
}
