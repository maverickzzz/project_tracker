<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $project_id = 0)
    {
        if ($project_id > 0) {
            return Inertia::render(
                'Dashboard/Payments/List',
                [
                    'data1' => Payment::filter()->where('project_id', $project_id)->orderByDesc('date')->get(),
                    'data2' => Payment::filter()->where('project_id', $project_id)->groupBy('project_id')->selectRaw('CAST(SUM(amount) AS INTEGER) as amount, project_id')->orderByDesc('amount')->get(),
                    'subtitle' => Project::filter()->where('id', $project_id)->first()
                ]
            );
        }

        return Inertia::render(
            'Dashboard/Payments/List',
            [
                'data1' => Payment::filter()->orderByDesc('date')->with('project')->get(),
                'data2' => Payment::filter()->groupBy('project_id')->selectRaw('CAST(SUM(amount) AS INTEGER) as amount, project_id')->orderByDesc('amount')->with('project')->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $project_id = 0)
    {
        return Inertia::render(
            'Dashboard/Payments/Create',
            [
                'projects' => Project::filter()->get(),
                'selected_project' => $project_id
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $data = $request->all();
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $data['user_id'] = auth()->user()->id;
        $data['owner_id'] = Project::where('id', $data['project_id'])->first()->owner_id;
        $data['amount'] = $request->input('is_expense') ? $data['amount'] * -1 : $data['amount'];
        unset($data['is_expense']);
        Payment::create($data);
        return redirect(session('origin'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return Inertia::render(
            'Dashboard/Payments/Edit',
            [
                'data' => $payment,
                'projects' => Project::filter()->get()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $data = $request->all();
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $data['owner_id'] = Project::where('id', $data['project_id'])->first()->owner_id;
        $data['amount'] = $request->input('is_expense') ? $data['amount'] * -1 : $data['amount'];
        unset($data['is_expense']);
        Payment::where('id', $payment->id)->update($data);
        return redirect(session('origin'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        // dd(session('origin'));
        // $payment->amount += 1;
        // $payment->update();
        $payment->delete();
        return redirect(session('origin'));
    }
}
