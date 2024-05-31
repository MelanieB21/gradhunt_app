<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoCollection;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VideoCollection::make(Video::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  

        $request->validate([
            'data.attributes.title' => ['required', 'string'],
            'data.attributes.slug' => ['required', 'string'],
            'data.attributes.description' => ['required', 'string'],
        ]);
        //almacenar datos
        $video = Video::create([
            'title'=>$request->input('data.attributes.title'),
            'slug'=>$request->input('data.attributes.slug'),
            'description'=>$request->input('data.attributes.description'),
        ]);
        //dd($video);
         return VideoResource::make($video);
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        return new VideoResource($video);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'data.attributes.title' => ['required', 'string'],
            'data.attributes.slug' => ['required', 'string'],
            'data.attributes.description' => ['required', 'string'],
            
        ]);

        $video->update([
            'title'=>$request->input('data.attributes.title'),
            'slug'=>$request->input('data.attributes.slug'),
            'description'=>$request->input('data.attributes.description'),
        ]);

        return VideoResource::make($video);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return response()->json(null,204);
    }
}
