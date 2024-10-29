<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupervisionAttendanceRequest;
use App\Http\Requests\UpdateSupervisionAttendanceRequest;
use App\Models\Cell;
use App\Models\CellMember;
use App\Models\District;
use App\Models\Member;
use App\Models\Sector;
use App\Models\SupervisionAttendance;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                    $attendances = SupervisionAttendance::where('sector_id', $sector->id)->whereBetween('date', [$start_date, $end_date])->orderBy('date','desc')->get();
                    break;
                case 'Pastor de Zona':
                    $zone = Zone::where('user_id', $user_id)->first();
                    $attendances = SupervisionAttendance::where('zone_id', $zone->id)->whereBetween('date', [$start_date, $end_date])->orderBy('date','desc')->get();
                    break;
                case 'Pastor de Distrito':
                    $district = District::where('user_id', $user_id)->first();
                    $zone = Zone::where('district_id', $district->id)->pluck('id');
                    $attendances = SupervisionAttendance::whereIn('zone_id', $zone)->whereBetween('date', [$start_date, $end_date])->orderBy('date','desc')->get();
                    break;
                case 'Pastor General':
                case 'Anciano':
                    $attendances = [];
                    break;
                default:
                    $attendances = [];
            }
        } else {
            switch ($role) {
                case 'Supervisor':
                    $sector = Sector::where('user_id', $user_id)->first();
                    $attendances = SupervisionAttendance::where('sector_id', $sector->id)->orderBy('date','desc')->get();
                    break;
                case 'Pastor de Zona':
                    $zone = Zone::where('user_id', $user_id)->first();
                    $attendances = SupervisionAttendance::where('zone_id', $zone->id)->orderBy('date','desc')->get();
                    break;
                case 'Pastor de Distrito':
                    $district = District::where('user_id', $user_id)->first();
                    $zone = Zone::where('district_id', $district->id)->pluck('id');
                    $attendances = SupervisionAttendance::whereIn('zone_id', $zone)->orderBy('date','desc')->get();
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
        $supervisor = '';

        switch ($role) {
            case 'Supervisor':
                $sector = Sector::where('user_id', $user_id)->first();
                $zone_id = $sector->zone_id;
                $cells = Cell::where('sector_id', $sector->id)->pluck('id');
                $members = CellMember::whereIn('cell_id', $cells)->whereHas('member', function ($query) {$query->where('status', 1);})->get();
                $user = User::find($user_id);
                $supervisor_member = Member::find($user->member_id);
                $supervisor = CellMember::where('member_id',$supervisor_member->id)->first();
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

        return view('modules.supervision_attendances.create', compact('zone_id','sector','members','supervision_attendance','supervisor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSupervisionAttendanceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSupervisionAttendanceRequest $request)
    {
        $validated_data = $request->validated();

        $validated_data['member_attendance'] = json_encode(request()->input('member_attendance'));
        $date = request()->input('date');
        $formattedDate = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        $validated_data['date'] = $formattedDate;
        // dd($validated_data);
        SupervisionAttendance::create($validated_data);

        return redirect()->route('supervision-attendances.index')->with('success','El registro ha sido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupervisionAttendance  $supervisionAttendance
     * @return \Illuminate\View\View
     */
    public function show(SupervisionAttendance $supervisionAttendance)
    {
        return view('modules.supervision_attendances.show',compact('supervisionAttendance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupervisionAttendance  $supervision_attendance
     * @return \Illuminate\View\View
     */
    public function edit(SupervisionAttendance $supervision_attendance)
    {
        $user_id = Auth::id();
        $role = auth()->user()->roles->pluck('name')[0];
        $members = [];
        $supervisor = '';

        switch ($role) {
            case 'Supervisor':
                $sector = Sector::where('user_id', $user_id)->first();
                $zone_id = $sector->zone_id;
                $cells = Cell::where('sector_id', $sector->id)->pluck('id');
                $members = CellMember::whereIn('cell_id', $cells)->whereHas('member', function ($query) {$query->where('status', 1);})->get();
                $user = User::find($user_id);
                $supervisor_member = Member::find($user->member_id);
                $supervisor = CellMember::where('member_id',$supervisor_member->id)->first();
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
        $supervision_attendance['member_attendance'] = isset($supervision_attendance->member_attendance) ? json_decode($supervision_attendance->member_attendance) : [];

        return view('modules.supervision_attendances.edit', compact('zone_id','sector','members','supervision_attendance','supervisor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupervisionAttendanceRequest  $request
     * @param  \App\Models\SupervisionAttendance  $supervisionAttendance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSupervisionAttendanceRequest $request, SupervisionAttendance $supervisionAttendance)
    {
        $validated_data = $request->validated();

        $validated_data['member_attendance'] = json_encode(request()->input('member_attendance'));
        $date = request()->input('date');
        $formattedDate = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        $validated_data['date'] = $formattedDate;

        $supervisionAttendance->fill($validated_data)->save();

        return redirect()->route('supervision-attendances.index')->with('success','El registro ha sido actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupervisionAttendance  $supervisionAttendance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SupervisionAttendance $supervisionAttendance)
    {
        $supervisionAttendance->delete();

        return redirect()->route('supervision-attendances.index')->with('success','El registro ha sido eliminado exitosamente');
    }
}
