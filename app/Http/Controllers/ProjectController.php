<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectEditRequest;
use App\Http\Requests\ProjectRequest;
use App\Models\Image;
use App\Models\Project;
use App\Models\ProjectService;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with(['images', 'services'])->orderBy('created_at', 'DESC')->paginate(10);
        $services = Service::get();
        $projectsCount = Project::get()->count();
        return view('projects.index', compact('services', 'projects', 'projectsCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->location = $request->location;
        $project->date = $request->date;
        $project->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {

                $filePath = $this->UserImageUpload($file); //passing parameter to our trait method one after another using foreach loop
                Image::insert([
                    'project_id' => $project->id,
                    'images' => $filePath
                ]);
            }
        }

        foreach ($request->type as $type) {
            ProjectService::insert([
                'project_id' => $project->id,
                'service_id' => $type,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        return redirect()->route('dashboard.projects')->with('created', 'Project successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project = Project::with(['images', 'services'])->find($project->id);
        return view('projects.view', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicesIds = [];
        $projectTemp = Project::with(['images', 'services'])->where('id', $id)->get();
        $services = Service::get();
        foreach ($projectTemp[0]->services as $service) {
            $servicesIds[] = $service->id;
        }
        return view('projects.edit', compact('projectTemp', 'services', 'servicesIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectEditRequest $request, $id)
    {
        $project = Project::find($id);
        $project->title = $request->title;
        $project->description = $request->description;
        $project->location = $request->location;
        $project->date = $request->date;
        $project->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {

                $filePath = $this->UserImageUpload($file);
                Image::insert([
                    'project_id' => $project->id,
                    'images' => $filePath,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
        Project::find($id)->services()->sync($request->type);

        return redirect()->route('dashboard.projects')->with('edited', 'Project successfully edited.');
    }

    /**
     * Process the image before saving to storage.
     */
    public function UserImageUpload($query)
    {
        $image_name = Str::random(20);
        $ext = strtolower($query->getClientOriginalExtension());
        $image_full_name = $image_name . '.' . $ext;
        $upload_path = 'storage/project_image/';
        $image_url = $upload_path . $image_full_name;
        $success = $query->move($upload_path, $image_full_name);

        return $image_url;
    }
}
