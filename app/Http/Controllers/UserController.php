<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id','desc')->paginate(10);
        $search_by = $request->get('search');
        return view('modules.users.index', compact('users', 'search_by'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = new User;
        $roles = Role::pluck('name', 'name')->all();
        return view('modules.users.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $validated_data = $request->validated();

        $validated_data['password'] = Hash::make($request->input('password'));

        $user = User::create($validated_data);

        $user->assignRole($request->input('role'));

        if ( $request->hasFile('profile-picture') && $request->file('profile-picture')->isValid() ) {
            $profile_picture = $request->file('profile-picture')->store('public');
            $user->profile_picture = $profile_picture;
        }

        return redirect()->route('users.index')->with('success', 'El registro ha sido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('modules.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $user_role = $user->roles->pluck('name', 'name')->all();

        return view('modules.users.edit', compact('user', 'roles', 'user_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, User  $user)
    {
        $validated_data = $request->validated();

        $input = $request->all();
        if (!empty($input['password'])) {
            $validated_data['password'] = Hash::make($request->input('password'));
        } else {
            $validated_data = Arr::except($validated_data, ['password']);
        }

        $user->fill($validated_data)->save();

        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($request->input('role'));

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'El usuario ha sido eliminado exitosamente.');
    }
}
