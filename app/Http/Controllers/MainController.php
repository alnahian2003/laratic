<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (view()->exists('test')) {
            return view("test");
        } else {
            return redirect(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("uploadImage");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        // return $request->cookie();
        // return redirect()->route('test.create')->withInput();

        // return $request->collect()->except("_token");

        if ($req->hasFile("image")) {
            if ($req->image->isValid()) {
                // $req->image->store('images');
                $req->image->storeAs('images', 'filename.jpg');
                // return back();
                // return redirect()->route('test.create', ['id' => 1]);

                // return response()->download($req->image);

                $filepath = storage_path("app/images/filename.jpg");

                return response()->file($filepath);

                return back()->with("test", "Image Uploaded Successfully");
            }
        }

        // if ($request->file('image')->isValid()) {
        //     if ($request->image->store('images')) {
        //         return redirect("test");
        //     }
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
