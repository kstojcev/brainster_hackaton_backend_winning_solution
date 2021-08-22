<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Project;

class ProjectApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with(['images', 'services'])->get();
        return response()->json($projects);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::where('id', $id)->with(['images', 'services'])->first();
        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::where('id', $id);
        $images = Image::where('project_id', $id)->get();
        $project->delete();
        foreach ($images as $image) {
            unlink($image->images);
        };
    }

    /**
     * Remove the specified image from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyImage($id)
    {
        $project = Image::where('id', $id)->firstOrFail();
        $project->delete();
        unlink($project->images);
    }
}
