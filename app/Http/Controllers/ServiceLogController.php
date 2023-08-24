<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Project;
use App\Models\ServiceLog;
use App\Http\Requests\StoreServiceLogRequest;
use App\Http\Requests\UpdateServiceLogRequest;

class ServiceLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $project_id = 0)
    {
        return Inertia::render(
            'Dashboard/ServiceLogs/Create',
            [
                'projects' => Project::filter()->get(),
                'selected_project' => $project_id
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceLogRequest $request)
    {
        $data = $request->all();
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $data['user_id'] = auth()->user()->id;
        $data['owner_id'] = Project::where('id', $data['project_id'])->first()->owner_id;
        ServiceLog::create($data);
        return redirect(session('origin'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceLog $serviceLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceLog $serviceLog)
    {
        return Inertia::render(
            'Dashboard/ServiceLogs/Edit',
            [
                'data' => $serviceLog,
                'projects' => Project::filter()->get()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceLogRequest $request, ServiceLog $serviceLog)
    {
        $data = $request->all();
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $data['owner_id'] = Project::where('id', $data['project_id'])->first()->owner_id;
        ServiceLog::where('id', $serviceLog->id)->update($data);
        return redirect(session('origin'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceLog $serviceLog)
    {
        $serviceLog->delete();
        return redirect(session('origin'));
    }
}
