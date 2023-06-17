<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Office;
use App\Models\Role;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('office', 'role')->whereHas('role', function($query) {
            return $query->where('name', '!=', 'DEV');
        })->orderBy('name', 'ASC')->paginate(12);

        $breadcrumb = [
            [
                'text' => 'Usuarios'
            ],
        ];

        return view('users.index', [
            'breadcrumb' => $breadcrumb,
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offices = Office::orderBy('name', 'ASC')->get();

        $roles = Role::where('name', '!=', 'DEV')->orderBy('display_name', 'ASC')->get();

        $breadcrumb = [
            [
                'text' => 'Usuarios',
                'route' => 'users.index'
            ],
            [
                'text' => 'Nuevo'
            ],
        ];

        return view('users.create', [
            'breadcrumb' => $breadcrumb,
            'offices' => $offices,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $user = new User($data);
        $user->save();

        return redirect()->route('users.show', ['id' => $user->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('office', 'role')->whereHas('role', function($query) {
            return $query->where('name', '!=', 'DEV');
        })->find($id);

        $breadcrumb = [
            [
                'text' => 'Usuarios',
                'route' => 'users.index'
            ],
            [
                'text' => $user?->name ?: 'Error 404'
            ],
        ];

        return view('users.show', [
            'breadcrumb' => $breadcrumb,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('office', 'role')->whereHas('role', function($query) {
            return $query->where('name', '!=', 'DEV');
        })->find($id);
        
        $offices = Office::orderBy('name', 'ASC')->get();

        $roles = Role::where('name', '!=', 'DEV')->orderBy('display_name', 'ASC')->get();

        $breadcrumb = [
            [
                'text' => 'Usuarios',
                'route' => 'users.index'
            ],
            [
                'text' => $user?->name ?: 'Error 404'
            ],
        ];

        return view('users.edit', [
            'breadcrumb' => $breadcrumb,
            'user' => $user,
            'offices' => $offices,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $data = $request->validated();

        $user = User::find($id);

        if (!isset($user)) {
            return redirect()->route('users.show', ['id' => $id]);
        }

        $user->update($data);

        return redirect()->route('users.show', ['id' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!isset($user)) {
            return redirect()->route('users.index');
        }

        $user->delete();

        return redirect()->route('users.index');
    }
}
