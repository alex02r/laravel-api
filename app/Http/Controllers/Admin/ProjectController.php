<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str ;

use function PHPUnit\Framework\isNull;

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
        $types = Type::all();
        return view('admin.projects.index-project', compact('projects', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create-project', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->all();
        $new_project = new Project();

        if ($request->hasFile('img')) {
            $img_path = Storage::disk('public')->put('uploads', $form_data['img']);
            $form_data['img'] = $img_path;
        }

        if ($request->has('checks')) {
            $new_project->technologies()->sync($form_data['checks']);
        }

        $new_project->fill($form_data);
        $new_project->slug = Str::slug($new_project->name, '-');
        $new_project->save();
        return redirect()->route('admin.project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show-project', compact('project'));
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
        $technologies = Technology::all();
        return view('admin.projects.edit-project', compact('project','types', 'technologies'));
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
        $form_data = $request->all();
        $id = Project::where('name', 'LIKE', $form_data['name'])->where('id', '!=', $project->id)->get();
        if (count($id) > 0) {
            $error_message = 'Hai inserito un titolo già presente in un altro articolo';
            return redirect()->route('admin.project.edit', compact('project', 'error_message'));
        }

        if ($request->hasFile('img')) {
            $img_path = Storage::disk('public')->put('uploads', $form_data['img']);
            $form_data['img'] = $img_path;
        }

        if ($request->has('checks')) {
            $project->technologies()->sync($form_data['checks']);
        }else{
            $project->technologies()->sync([]);
        }

        $form_data['slug'] = Str::slug($form_data['name'], '-');
        
        unset($form_data['checks']);
        $project->update($form_data);
        return redirect()->route('admin.project.show', ['project'=>$project]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        Storage::disk('public')->delete($project->img);
        $project->delete();
        return redirect()->route('admin.project.index');
    }
}
