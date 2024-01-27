<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = UserGroup::filter();

        $filter = $request->query();
        if (isset($filter['search'])) {
            $data
                ->where(function ($query) use ($filter) {
                    $query->where('name', 'like', '%' . $filter['search'] . '%');
                });
        }

        return Inertia::render(
            'Dashboard/UserGroups/List',
            [
                'data' => $data->paginate(10)->withQueryString()
            ]
        );
    }

    public function create()
    {
        return Inertia::render(
            'Dashboard/UserGroups/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $data = $request->validate([
//            'name' => 'required',
//        ]);

        $data['name'] = $request->input('name');
        $data['access'] = json_encode($request->input('access'));
        UserGroup::create($data);
        return redirect(session('origin'));
    }

    /**
     * Display the specified resource.
     */
    public function show(UserGroup $usergroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserGroup $usergroup)
    {
        return Inertia::render(
            'Dashboard/UserGroups/Edit',
            [
                'data' => $usergroup
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserGroup $usergroup)
    {
//        dd($request);
//        $data = $request->validate([
//            'name' => 'required',
//        ]);
        $data['name'] = $request->input('name');
//        $data['access'] = json_encode($request->input('access'));
        $data['access'] = $request->input('access');

        UserGroup::where('id', $usergroup->id)->update($data);
        return redirect(session('origin'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserGroup $usergroup)
    {
        $usergroup->delete();
        return redirect(session('origin'));
    }
}
