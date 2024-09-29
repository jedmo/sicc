<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sector;
use App\Models\Zone;
use App\Http\Requests\StoreSectorRequest;
use App\Http\Requests\UpdateSectorRequest;
use App\Traits\DataFilterTrait;

class SectorController extends Controller
{
    use DataFilterTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index($zone_id = null)
    {
        if (!$zone_id){
            $sectors = $this->getSector();
        } else {
            $sectors = Sector::where('zone_id', $zone_id)->orderBy('code','asc')->paginate(10);
        }

        return view('modules.sectors.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();
        $zones = Zone::all();
        $sector = new Sector;
        return view('modules.sectors.create', compact('users', 'sector', 'zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSectorRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSectorRequest $request)
    {
        $code = $request->input('code');
        $zone_id = $request->input('zone_id');
        $zone = Zone::find($zone_id);
        $validated_data = $request->validated();
        $validated_data['full_code'] = $zone->full_code . ' S:' . $code;
        Sector::create($validated_data);
        return redirect()->route('sectors.index')->with('success','El sector ha sido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\View\View
     */
    public function show(Sector $sector)
    {
        return view('modules.sectors.show',compact('sector'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\View\View
     */
    public function edit(Sector $sector)
    {
        $users = User::all();
        $zones = Zone::all();
        return view('modules.sectors.edit',compact('sector', 'users', 'zones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSectorRequest  $request
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSectorRequest $request, Sector $sector)
    {
        $code = $request->input('code');
        $zone_id = $request->input('zone_id');
        $zone = Zone::find($zone_id);
        $validated_data = $request->validated();
        $validated_data['full_code'] = $zone->full_code . ' S:' . $code;
        $sector->fill($validated_data)->save();
        return redirect()->route('sectors.index')->with('success','El sector ha sido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Sector $sector)
    {
        $sector->delete();
        return redirect()->route('sectors.index')->with('success','El sector ha sido eliminado exitosamente');
    }
}
