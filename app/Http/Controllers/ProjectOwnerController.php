<?php

namespace App\Http\Controllers;

use App\Models\ProjectOwner;
use App\Http\Requests\StoreProjectOwnerRequest;
use App\Http\Requests\UpdateProjectOwnerRequest;
use App\Models\Payment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProjectOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render(
            'Dashboard/ProjectOwners/List',
            [
                'data' => ProjectOwner::filter()->addSelect([
                    'total_projects' => Project::filter()->selectRaw('CAST(COUNT(0) AS INTEGER)')->whereColumn('owner_id', 'project_owners.id')->groupBy('owner_id'),
                    'total_payment' => Payment::filter()->selectRaw('CAST(SUM(amount) AS INTEGER)')
                        ->whereColumn('owner_id', 'project_owners.id')
                        ->where('amount', '>', 0)
                        ->groupBy('owner_id')
                ])->orderByDesc('total_payment')->get()->map(function ($item) {
                    $item->total_payment = $item->total_payment ?? 0;
                    return $item;
                })
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render(
            'Dashboard/ProjectOwners/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectOwnerRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        ProjectOwner::create($data);
        return redirect(session('origin'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectOwner $projectOwner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectOwner $projectOwner)
    {
        return Inertia::render(
            'Dashboard/ProjectOwners/Edit',
            [
                'data' => $projectOwner
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectOwnerRequest $request, ProjectOwner $projectOwner)
    {
        ProjectOwner::where('id', $projectOwner->id)->update($request->all());
        return redirect(session('origin'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectOwner $projectOwner)
    {
        $project = Project::where('owner_id', $projectOwner->id)->get();
        if (count($project) > 0) {
            dd($project);
        }
        $projectOwner->delete();
        return redirect(session('origin'));
    }
}
