<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Payment;
use App\Models\ProjectOwner;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, int $owner_id = 0)
    {
        $data = Project::filter()->with('owner');

        $filter = $request->query();
        if (isset($filter['search'])) {
            $data
                ->where(function ($query) use ($filter) {
                    $query->where('name', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('referrer', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('url', 'like', '%' . $filter['search'] . '%')
                        ->orWhereHas('owner', function ($query) use ($filter) {
                            $query->where('name', 'like', '%' . $filter['search'] . '%');
                        });
                });
        }

        if ($owner_id > 0) {
            return Inertia::render(
                'Dashboard/Projects/List',
                [
                    'data' => $data->where('owner_id', $owner_id)->paginate(10)->withQueryString(),
                    'subtitle' => ProjectOwner::filter()->where('id', $owner_id)->first(),
                    'services' => Service::filter()->where('is_active', 1)->get()
                ]
            );
        }

        return Inertia::render(
            'Dashboard/Projects/List',
            [
                'data' => $data->paginate(10)->withQueryString(),
                'services' => Service::filter()->where('is_active', 1)->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render(
            'Dashboard/Projects/Create',
            [
                'owners' => ProjectOwner::filter()->get()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $project = Project::create($data);

        $service['user_id'] = $data['user_id'];
        $service['project_id'] = $project->id;
        $service['owner_id'] = $project->owner_id;
        $service['start_date'] = date('Y-m-d');
        $service['end_date'] = date('Y-m-d');
        $service['currency'] = '';
        $service['amount'] = 0;
        $service['notes'] = '';
        $service['is_active'] = 0;

        $service['type'] = 'Maintenance';
        Service::create($service);

        $service['type'] = 'SEO';
        Service::create($service);

        $service['type'] = 'Domain';
        Service::create($service);

        $service['type'] = 'Hosting';
        Service::create($service);

        return redirect(session('origin'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return Inertia::render(
            'Dashboard/Projects/Edit',
            [
                'data' => $project,
                'owners' => ProjectOwner::filter()->get()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        Project::where('id', $project->id)->update($request->all());

        $services = Service::filter()->where('project_id', $project->id)->get();

        $service['user_id'] = auth()->user()->id;
        $service['project_id'] = $project->id;
        $service['owner_id'] = $project->owner_id;
        $service['start_date'] = date('Y-m-d');
        $service['end_date'] = date('Y-m-d');
        $service['currency'] = '';
        $service['amount'] = 0;
        $service['notes'] = '';
        $service['is_active'] = 0;

        if (!$services->first(function ($item) {
            return $item->type == 'Maintenance';
        })) {
            $service['type'] = 'Maintenance';
            Service::create($service);
        }

        if (!$services->first(function ($item) {
            return $item->type == 'SEO';
        })) {
            $service['type'] = 'SEO';
            Service::create($service);
        }

        if (!$services->first(function ($item) {
            return $item->type == 'Domain';
        })) {
            $service['type'] = 'Domain';
            Service::create($service);
        }

        if (!$services->first(function ($item) {
            return $item->type == 'Hosting';
        })) {
            $service['type'] = 'Hosting';
            Service::create($service);
        }

        return redirect(session('origin'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $payment = Payment::where('project_id', $project->id)->get();
        if (count($payment) > 0) {
            dd($payment);
        }
        $project->delete();
        return redirect(session('origin'));
    }
}
