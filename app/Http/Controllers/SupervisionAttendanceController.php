<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupervisionAttendanceRequest;
use App\Http\Requests\UpdateSupervisionAttendanceRequest;
use App\Models\Cell;
use App\Models\District;
use App\Models\Sector;
use App\Models\SupervisionAttendance;
use App\Models\Zone;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\CellMember;

class SupervisionAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $week = request('week');
        $attendances = [];
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        if (!empty($week)) {
            $dates = explode(' - ', $week);
            $start_date = Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d');
            $end_date = Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d');
            switch ($role) {
                case 'Supervisor':
                    $sector = Sector::where('user_id', $user_id)->first();
                    $attendances = SupervisionAttendance::where('start_date', $start_date)->where('end_date', $end_date)->whereIn('sector_id', $sector->id)->orderBy('start_date','desc')->get();
                    break;
                case 'Pastor de Zona':
                    $zone = Zone::where('user_id', $user_id)->first();
                    $attendances = SupervisionAttendance::where('start_date', $start_date)->where('end_date', $end_date)->whereIn('zone_id', $zone->id)->orderBy('start_date','desc')->get();
                    break;
                case 'Pastor de Distrito':
                    $district = District::where('user_id', $user_id)->first();
                    $zone = Zone::where('district_id', $district->id)->pluck('id');
                    $attendances = SupervisionAttendance::where('start_date', $start_date)->where('end_date', $end_date)->whereIn('zone_id', $zone)->orderBy('start_date','desc')->get();
                    break;
                case 'Pastor General':
                case 'Anciano':
                    $attendances = [];
                    break;
                default:
                    $attendances = [];
            }
        }

        return view('modules.supervision_attendances.index', compact('attendances', 'week'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user_id = Auth::id();
        $role = auth()->user()->roles->pluck('name')[0];
        $members = [];
        switch ($role) {
            case 'Supervisor':
                $sector = Sector::where('user_id', $user_id)->first();
                $zone_id = $sector->zone_id;
                $cells = Cell::where('sector_id', $sector->id)->pluck('id');
                $members = CellMember::whereIn('cell_id', $cells)->whereHas('member', function ($query) {$query->where('status', 1);})->get();
              break;
            case 'Pastor de Zona':
                $zone = Zone::where('user_id', $user_id)->first();
                $zone_id = $zone->id;
                $sector = Sector::where('zone_id', $zone->id)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                $members = CellMember::whereIn('cell_id', $cells)->whereHas('member', function ($query) {$query->where('status', 1);})->get();
              break;
            default:
                $members = [];
        }

        $supervision_attendance = new SupervisionAttendance();

        return view('modules.supervision_attendances.create', compact('zone_id','sector','members','supervision_attendance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSupervisionAttendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupervisionAttendanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupervisionAttendance  $supervisionAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(SupervisionAttendance $supervisionAttendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupervisionAttendance  $supervisionAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(SupervisionAttendance $supervisionAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupervisionAttendanceRequest  $request
     * @param  \App\Models\SupervisionAttendance  $supervisionAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupervisionAttendanceRequest $request, SupervisionAttendance $supervisionAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupervisionAttendance  $supervisionAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupervisionAttendance $supervisionAttendance)
    {
        //
    }
}
