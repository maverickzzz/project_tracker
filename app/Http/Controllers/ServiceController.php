<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ServiceLog;
use Inertia\Inertia;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $project_id = 0)
    {
        if ($project_id > 0) {
            $project_payments = Payment::filter()->where('project_id', $project_id)->orderByDesc('date');

            return Inertia::render(
                'Dashboard/Services/Index',
                [
                    'project' => Project::filter()->where('id', $project_id)->with(['owner'])->first(),
                    'data' => Service::filter()->where('project_id', $project_id)->orderBy('type')->get(),
                    // 'payments' => Payment::filter()->where('project_id', $project_id)->where('amount', '>', 0)->orderByDesc('date')->get(),
//                    'payments' => collect($project_payments)->where('amount', '>', 0)->values(),
                    'payments' => $project_payments->where('amount', '>', 0)->paginate(10)->withQueryString(),
                    // 'expenses' => Payment::filter()->where('project_id', $project_id)->where('amount', '<', 0)->orderByDesc('date')->get(),
//                    'expenses' => collect($project_payments)->where('amount', '<', 0)->values(),
                    'expenses' => $project_payments->where('amount', '<', 0)->paginate(10)->withQueryString(),
                    'logs' => ServiceLog::filter()->where('project_id', $project_id)->orderByDesc('date')->paginate(10)->withQueryString(),
                ]
            );
        }

        return redirect(session('origin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $project_id, int $service_id)
    {
        return Inertia::render('Dashboard/Services/Edit', [
            'data' => Service::filter()->where('project_id', $project_id)->where('id', $service_id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        Service::where('id', $service->id)->update($request->all());

        // $log = new ServiceLog();
        // $log->user_id = auth()->user()->id;
        // $log->service_id = $service->id;
        // $log->start_date = $request->start_date;
        // $log->end_date = $request->end_date;
        // $log->currency = $request->currency;
        // $log->amount = $request->amount;
        // $log->notes = $request->notes;
        // $log->is_active = $request->is_active;
        // $log->save();

        return redirect('/projects/' . $service->project_id. '/services');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }

    public function logs(int $project_id, int $service_id)
    {
        $services = ServiceLog::filter()->where('service_id', $service_id)->get();
        dd($project_id, $service_id, $services);
    }
}
