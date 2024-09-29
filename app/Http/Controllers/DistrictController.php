<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\District;
use App\Http\Requests\StoreDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $districts = District::orderBy('id','desc')->paginate(10);
        return view('modules.districts.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();
        $district = new District;
        return view('modules.districts.create', compact('users', 'district'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDistrictRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreDistrictRequest $request)
    {
        $code = $request->input('code');
        $validated_data = $request->validated();
        $validated_data['full_code'] = 'D:' . $code;
        District::create($validated_data);
        return redirect()->route('districts.index')->with('success','El distrito ha sido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\View\View
     */
    public function show(District $district)
    {
        return view('modules.districts.show',compact('district'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\View\View
     */
    public function edit(District $district)
    {
        $users = User::all();
        return view('modules.districts.edit',compact('district', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDistrictRequest  $request
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateDistrictRequest $request, District $district)
    {
        $code = $request->input('code');
        $validated_data = $request->validated();
        $validated_data['full_code'] = 'D:' . $code;
        $district->fill($validated_data)->save();
        return redirect()->route('districts.index')->with('success','El distrito ha sido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(District $district)
    {
        $district->delete();
        return redirect()->route('districts.index')->with('success','El distrito ha sido eliminado exitosamente');
    }
}
