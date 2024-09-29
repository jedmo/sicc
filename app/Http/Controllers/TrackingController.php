<?php

namespace App\Http\Controllers;

use App\Enums\StepEnum;
use App\Http\Requests\StoreTrackingRequest;
use App\Http\Requests\UpdateTrackingRequest;
use App\Models\Member;
use App\Models\Tracking;
use Carbon\Carbon;

class TrackingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($member_id)
    {
        $steps = StepEnum::cases();
        $tracking = new Tracking;
        $member = Member::find($member_id);
        return view('modules.trackings.create', compact('steps', 'tracking', 'member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTrackingRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTrackingRequest $request)
    {
        $validated_data = $request->validated();

        $date = $validated_data['step_date'];
        $formattedDate = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        $validated_data['step_date'] = $formattedDate;

        Tracking::create($validated_data);

        return redirect()->route('members.index')->with('success','Datos del miembro actualizados con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function show($member_id)
    {
        $trackings = Tracking::where('member_id', $member_id)->get();
        return view('modules.trackings.show',compact('trackings', 'member_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tracking  $tracking
     * @return \Illuminate\View\View
     */
    public function edit(Tracking $tracking)
    {
        $steps = StepEnum::cases();
        return view('modules.trackings.edit',compact('tracking', 'steps'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTrackingRequest  $request
     * @param  \App\Models\Tracking  $tracking
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTrackingRequest $request, Tracking $tracking)
    {
        $validated_data = $request->validated();

        $date = $validated_data['step_date'];
        $formattedDate = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        $validated_data['step_date'] = $formattedDate;

        $tracking->fill($validated_data)->save();

        return redirect()->route('trackings.show', $request->input('member_id'))->with('success','Datos del miembro actualizados con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tracking  $tracking
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tracking $tracking, $member_id)
    {
        $tracking->delete();
        return redirect()->route('trackings.show', $member_id)->with('success','Proceso removido exitosamente.');
    }
}
