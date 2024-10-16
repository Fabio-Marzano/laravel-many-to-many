<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Technology;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies= Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('projects_image', $request->file('image'));
            $form_data['image'] = $path;
        }

        $form_data['slug'] = Project::generateSlug($form_data['title'], '_');
        
        $project = new Project();
        $project->fill($form_data);
        $project->save();

        if ($request->has('technologies')) {
            $technologies = $request->technologies;  
            $project->technologies()->attach($technologies);  
        }
        
        
        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all(); 
        $technologies= Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();

        if ($request->hasFile('image')) {
            if ($project->image != null) {
                Storage::delete($project->image);
            }

            $path = Storage::put('projects_image', $form_data['image']);
            $form_data['image'] = $path;
        }

        $form_data['slug'] = Project::generateSlug($form_data['title']);

        $project->fill($form_data);

        if($request->has('technologies')){
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->sync([]);  
        }

        $project->save();

        return redirect()->route('admin.projects.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->image !== null) {
            Storage::delete($project->image);
        }
        
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}