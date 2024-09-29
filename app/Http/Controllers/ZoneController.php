<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZoneRequest;
use App\Http\Requests\UpdateZoneRequest;
use App\Models\District;
use App\Models\User;
use App\Models\Zone;
use App\Traits\DataFilterTrait;

class ZoneController extends Controller
{
    use DataFilterTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index($district_id = null)
    {
        if (!$district_id){
            $zones = $this->getZone();
        } else {
            $zones = Zone::where('district_id', $district_id)->orderBy('id','desc')->paginate(10);
        }
        return view('modules.zones.index', compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();
        $districts = District::all();
        $zone = new Zone;
        return view('modules.zones.create', compact('users', 'zone', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreZoneRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreZoneRequest $request)
    {
        $code = $request->input('code');
        $district_id = $request->input('district_id');
        $district = District::find($district_id);
        $validated_data = $request->validated();
        $validated_data['full_code'] = $district->full_code . ' Z:' . $code;
        Zone::create($validated_data);
        return redirect()->route('zones.index')->with('success','La zona ha sido creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\View\View
     */
    public function show(Zone $zone)
    {
        return view('modules.zones.show',compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\View\View
     */
    public function edit(Zone $zone)
    {
        $users = User::all();
        $districts = District::all();
        return view('modules.zones.edit',compact('zone', 'users', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateZoneRequest  $request
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateZoneRequest $request, Zone $zone)
    {
        $code = $request->input('code');
        $district_id = $request->input('district_id');
        $district = District::find($district_id);
        $validated_data = $request->validated();
        $validated_data['full_code'] = $district->full_code . ' Z:' . $code;
        $zone->fill($validated_data)->save();
        return redirect()->route('zones.index')->with('success','La zona ha sido actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Zone $zone)
    {
        $zone->delete();
        return redirect()->route('zones.index')->with('success','La zona ha sido eliminada exitosamente');
    }
}
