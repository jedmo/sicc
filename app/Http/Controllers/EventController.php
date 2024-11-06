<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Cell;
use App\Models\District;
use App\Models\Event;
use App\Models\Sector;
use App\Models\Zone;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];
        $z_events = '';
        $d_events = '';
        $g_events = Event::where('type', 'general')->whereDate('start_date', '>=', Carbon::now())->get();

        switch ($role) {
            case 'Líder':
                $cell = Cell::where('user_leader_id', $user_id)->first();
                $sector = Sector::find($cell['sector_id']);
                $z_events = Event::where('zone_id', $sector['zone_id'])->whereDate('start_date', '>=', Carbon::now())->get();
                $zone = Zone::where('zone_id', $sector['zone_id'])->first();
                $d_events = Event::where('zone_id', '')->where('district_id', $zone['district_id'])->whereDate('start_date', '>=', Carbon::now())->get();
                break;
            case 'Supervisor':
                $sector = Sector::where('user_id', $user_id)->first();
                $z_events = Event::where('zone_id', $sector['zone_id'])->whereDate('start_date', '>=', Carbon::now())->get();
                $zone = Zone::where('zone_id', $sector['zone_id'])->first();
                $d_events = Event::where('zone_id', '')->where('district_id', $zone['district_id'])->whereDate('start_date', '>=', Carbon::now())->get();
                break;
            case 'Pastor de Zona':
                $zone = Zone::where('user_id', $user_id)->first();
                $z_events = Event::where('zone_id', $zone->id)->whereDate('start_date', '>=', Carbon::now())->get();
                $d_events = Event::where('zone_id', '')->where('district_id', $zone->district_id)->whereDate('start_date', '>=', Carbon::now())->get();
                break;
            case 'Pastor de Distrito':
                $district = District::where('user_id', $user_id)->first();
                $d_events = Event::where('district_id', $district->id)->whereDate('start_date', '>=', Carbon::now())->get();
                break;
            default:
        }

        return view('modules.events.index', compact( 'z_events', 'd_events', 'g_events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $event = new Event();
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];
        $zones = Zone::all();
        $districts = District::all();

        return view('modules.events.create', compact('event','role', 'zones', 'districts', 'user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreEventRequest $request)
    {
        $validated_data = $request->validated();
        $file = $request->file('image');
        if ($file) {
            $image =  time()."_".$file->getClientOriginalName();
            Storage::disk('local')->put($image,  File::get($file));
            $validated_data['image'] = $image;
        }

        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];
        if($validated_data['type'] == 'zona') {
            $zone = Zone::find($validated_data['zone_id']);
            $validated_data['district_id'] = $zone['district_id'];
        //     case 'zona':
        //         $zone_id = Zone::where('user_id', $user_id)->first()->id();
        //         $validated_data['zone_id'] = $zone_id;
        //         break;
        //     case 'distrito':
        //         $district_id = District::where('user_id', $user_id)->first()->id();
        //         $validated_data['district_id'] = $district_id;
        //         break;
        //     default:
        //         $zone_id = Zone::where('user_id', $user_id)->first()->id();
        //         break;
        }

        $s_date = $validated_data['start_date'];
        $e_date = $validated_data['end_date'];
        $s_time = $validated_data['start_time'];
        $e_time = $validated_data['end_time'];
        $validated_data['start_date'] = !empty($s_date) ? Carbon::createFromFormat('d/m/Y', $s_date)->format('Y-m-d') : null;
        $validated_data['end_date'] = !empty($e_date) ? Carbon::createFromFormat('d/m/Y', $e_date)->format('Y-m-d') : null;
        $validated_data['start_time'] = !empty($s_time) ? Carbon::createFromFormat('H:i a', $s_time)->format('H:i:s') : null;
        $validated_data['end_time'] = !empty($e_time) ? Carbon::createFromFormat('H:i a', $e_time)->format('H:i:s') : null;
        $validated_data['user_id'] = Auth::id();

        Event::create($validated_data);

        return redirect()->route('events.index')->with('success','Nuevo evento agregado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    // public function show(Event $event)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\View\View
     */
    public function edit(Event $event)
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];
        $zones = Zone::all();
        $districts = District::all();

        return view('modules.events.edit', compact('event', 'role', 'zones', 'districts', 'user_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $validated_data = $request->validated();
        $file = $request->file('image');
        if ($file) {
            $image =  time()."_".$file->getClientOriginalName();
            Storage::disk('local')->put($image,  File::get($file));
            $validated_data['image'] = $image;
        }

        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];
        if($validated_data['type'] == 'zona') {
            $zone = Zone::find($validated_data['zone_id']);
            $validated_data['district_id'] = $zone['district_id'];
        //     case 'zona':
        //         $zone_id = Zone::where('user_id', $user_id)->first()->id();
        //         $validated_data['zone_id'] = $zone_id;
        //         break;
        //     case 'distrito':
        //         $district_id = District::where('user_id', $user_id)->first()->id();
        //         $validated_data['district_id'] = $district_id;
        //         break;
        //     default:
        //         $zone_id = Zone::where('user_id', $user_id)->first()->id();
        //         break;
        }

        $s_date = $validated_data['start_date'];
        $e_date = $validated_data['end_date'];
        $s_time = $validated_data['start_time'];
        $e_time = $validated_data['end_time'];
        $validated_data['start_date'] = !empty($s_date) ? Carbon::createFromFormat('d/m/Y', $s_date)->format('Y-m-d') : null;
        $validated_data['end_date'] = !empty($e_date) ? Carbon::createFromFormat('d/m/Y', $e_date)->format('Y-m-d') : null;
        $validated_data['start_time'] = !empty($s_time) ? Carbon::createFromFormat('H:i a', $s_time)->format('H:i:s') : null;
        $validated_data['end_time'] = !empty($e_time) ? Carbon::createFromFormat('H:i a', $e_time)->format('H:i:s') : null;
        $validated_data['user_id'] = Auth::id();

        $event->fill($validated_data)->save();

        return redirect()->route('events.index')->with('success','Evento actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Event $event)
    // {
    //     //
    // }
}
