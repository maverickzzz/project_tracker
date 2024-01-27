<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserUsergroupCompany;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = DB::table('users')
            ->leftJoin('users_usergroups_companies', function (JoinClause $join) {
                $join->on('users.id', '=', 'users_usergroups_companies.user_id');
            })
            ->leftJoin('usergroups', 'users_usergroups_companies.usergroup_id', '=', 'usergroups.id')
            ->where('users_usergroups_companies.company_id', session('company_id'));

        if (auth()->user()->id <> 1) {
            $data = $data->where('users.id', '<>', 1);
        }

        $filter = $request->query();
        if (isset($filter['usergroup']) && $filter['usergroup'] < 99) $data->where('users_usergroups_companies.usergroup_id', '=', $filter['usergroup']);
        if (isset($filter['search'])) {
            $data
                ->where(function ($query) use ($filter) {
                    $query->where('users.name', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('users.username', 'like', '%' . $filter['search'] . '%');
                });
        }

        return Inertia::render(
            'Dashboard/Users/List',
            [
                'data' => $data->select('users.id', 'users.name', 'users.username', 'usergroups.name AS usergroup_name', 'usergroups.id AS usergroup_id')->paginate(10)
                    ->withQueryString()
//                'data' => DB::select('SELECT A.*, C.name AS usergroup_name, C.id AS usergroup_id
//                    FROM users A
//                    LEFT JOIN users_usergroups_companies B ON A.id = B.user_id AND B.company_id = ?
//                    LEFT JOIN usergroups C ON B.usergroup_id = C.id
//                    WHERE A.id <> 1
//                ', [session('company_id')])
            ]
        );
    }

    public function create()
    {
        return Inertia::render(
            'Dashboard/Users/Create',
            [
                'usergroups' => UserGroup::get()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
        $data['password'] = bcrypt('password');
        User::create($data);
        return redirect(session('origin'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render(
            'Dashboard/Users/Edit',
            [
                'data' => $user,
                'usergroups' => UserGroup::get()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required',
        ]);
        if ($request->input('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }
        User::where('id', $user->id)->update($data);
        return redirect(session('origin'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(session('origin'));
    }

    public function setAccess()
    {
        $data = User::get();
        $usergroups = UserGroup::get();
        if (auth()->user()->id <> 1) {
            $data = User::where('users.id', '<>', 1)->get();
            $usergroups = UserGroup::where('id', '<>', 1)->get();
        }

        return Inertia::render(
            'Dashboard/Users/SetAccess',
            [
                'data' => $data,
                'maps' => UserUsergroupCompany::where('company_id', session('company_id'))->get(),
                'usergroups' => $usergroups
            ]
        );
    }

    public function saveAccess(Request $request)
    {
        $users = $request->all();

        foreach ($users['usergroup_id'] as $user_id => $usergroup_id) {
            if ($user_id && $usergroup_id) {
                $user = UserUsergroupCompany::where('company_id', session('company_id'))->where('user_id', $user_id)->first();
                $data = [];

                if ($user) {
                    $data = $user->toArray();
                    $data['usergroup_id'] = $usergroup_id;
                    UserUsergroupCompany::where('id', $data['id'])->update($data);
                } else {
                    $data['user_id'] = $user_id;
                    $data['usergroup_id'] = $usergroup_id;
                    $data['company_id'] = session('company_id');
                    UserUsergroupCompany::insert($data);
                }
            }
        }
        return redirect('/users');
    }

    public function impersonate(int $user_id)
    {
        $original_id = auth()->user()->id;
        $original_usergroup_id = session('usergroup_id');
        session()->put('impersonate', ['id' => $original_id, 'usergroup_id' => $original_usergroup_id]);
        auth()->loginUsingId($user_id);
        session()->put('usergroup_id', UserUsergroupCompany::where('user_id', auth()->user()->id)->where('company_id', session('company_id'))->first()->usergroup_id ?? 0);

//        dd(session());
        return redirect('/users');
    }

    public function leave()
    {
        if (session()->has('impersonate')) {
            auth()->loginUsingId(session('impersonate.id'));
            session()->put('usergroup_id', session('impersonate.usergroup_id'));
            session()->forget('impersonate');
        }

        return redirect('/users');
    }

    public function change_password()
    {
        return Inertia::render('Dashboard/Users/ChangePassword');
    }

    public function do_change_password(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:7|confirmed',
        ]);

        // Get the current user
        $user = auth()->user();

        // Verify old password
        $credentials['username'] = auth()->user()->username;
        $credentials['password'] = $request->old_password;
        if (!Auth::attempt($credentials)) {
            return redirect()->back()->with('error', 'Old password is incorrect');
        }

        // Change password
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully');
    }
}
