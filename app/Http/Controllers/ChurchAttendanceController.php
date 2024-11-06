<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChurchAttendanceRequest;
use App\Http\Requests\UpdateChurchAttendanceRequest;
use App\Models\Cell;
use App\Models\CellMember;
use App\Models\ChurchAttendance;
use App\Models\District;
use App\Models\Sector;
use App\Models\Zone;
use App\Traits\DataFilterTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChurchAttendanceController extends Controller
{
    use DataFilterTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $week = request('week');
        $church_attendances = [];
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];
        $start_week = Carbon::now()->startOfWeek();
        $existing = false;
        $start_date = '';

        if ($role == 'Líder') {
            $cell = Cell::where('user_leader_id', $user_id)->first();
            $church_attendances = ChurchAttendance::where('cell_id', $cell->id)->orderBy('start_date','desc')->get();
            $existing = ChurchAttendance::where('cell_id', $cell->id)->whereDate('start_date', '>=', $start_week)->exists();
        } else {
            if (!empty($week)) {
                $dates = explode(' - ', $week);
                $start_date = Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d');
                $end_date = Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d');
            }
            switch ($role) {
                case 'Supervisor':
                    $sector = Sector::where('user_id', $user_id)->first();
                    $cells = Cell::where('sector_id', $sector->id)->pluck('id');
                    if ($start_date) {
                        $church_attendances = ChurchAttendance::where('start_date', $start_date)->where('end_date', $end_date)->whereIn('cell_id', $cells)->orderBy('start_date','desc')->get();
                    } else {
                        $church_attendances = ChurchAttendance::whereIn('cell_id', $cells)->orderBy('start_date','desc')->get();
                    }
                    $existing = ChurchAttendance::whereIn('cell_id', $cells)->whereDate('start_date', '>=', $start_week)->exists();
                    break;
                case 'Pastor de Zona':
                    $zone = Zone::where('user_id', $user_id)->first();
                    $sector = Sector::where('zone_id', $zone->id)->pluck('id');
                    $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                    if ($start_date) {
                        $church_att = ChurchAttendance::where('start_date', $start_date)->where('end_date', $end_date)->whereIn('cell_id', $cells)->orderBy('start_date','desc')->get();
                    } else {
                        $church_att = ChurchAttendance::whereIn('cell_id', $cells)->orderBy('start_date','desc')->get();
                    }
                    $existing = ChurchAttendance::whereIn('cell_id', $cells)->whereDate('start_date', '>=', $start_week)->exists();

                    $church_attendances = $church_att->groupBy(function ($attendance) {
                        return $attendance->cell->sector->id . '|' . $attendance->start_date;
                    })->map(function ($attendances, $sector_id) {
                        $sector = $attendances->first()->cell->sector;
                        $attendanceSummary = new ChurchAttendance();

                        $attendanceSummary->start_date = $attendances->first()->start_date;
                        $attendanceSummary->end_date = $attendances->first()->end_date;
                        $attendanceSummary->full_code = $sector->full_code;
                        $attendanceSummary->supervisor = $sector->user->member->full_name;
                        $attendanceSummary->sibling_attendance_1d = $attendances->sum(function ($attendance) {
                            return $attendance->sibling_attendance_1d;
                        });
                        $attendanceSummary->friends_attendance_1d = $attendances->sum(function ($attendance) {
                            return $attendance->friends_attendance_1d;
                        });
                        $attendanceSummary->total_attendance_1d = $attendances->sum(function ($attendance) {
                            return $attendance->total_attendance_1d;
                        });
                        $attendanceSummary->sibling_attendance_2d = $attendances->sum(function ($attendance) {
                            return $attendance->sibling_attendance_2d;
                        });
                        $attendanceSummary->friends_attendance_2d = $attendances->sum(function ($attendance) {
                            return $attendance->friends_attendance_2d;
                        });
                        $attendanceSummary->total_attendance_2d = $attendances->sum(function ($attendance) {
                            return $attendance->total_attendance_2d;
                        });
                        $attendanceSummary->sibling_attendance_sd = $attendances->sum(function ($attendance) {
                            return $attendance->sibling_attendance_sd;
                        });
                        $attendanceSummary->friends_attendance_sd = $attendances->sum(function ($attendance) {
                            return $attendance->friends_attendance_sd;
                        });
                        $attendanceSummary->total_attendance_sd = $attendances->sum(function ($attendance) {
                            return $attendance->total_attendance_sd;
                        });
                        $attendanceSummary->total_attendance_week = $attendances->sum(function ($attendance) {
                            return $attendance->total_attendance_week;
                        });

                        // Retornar la instancia del modelo
                        return $attendanceSummary;
                    })->sortBy('full_code');

                    break;
                case 'Pastor de Distrito':
                    $district = District::where('user_id', $user_id)->first();
                    $zone = Zone::where('district_id', $district->id)->pluck('id');
                    $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                    $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                    $church_attendances = ChurchAttendance::whereIn('cell_id', $cells)->orderBy('start_date','desc')->get();
                    $existing = ChurchAttendance::whereIn('cell_id', $cells)->whereDate('start_date', '>=', $start_week)->exists();
                    break;
                case 'Pastor General':
                case 'Anciano':
                    $church_attendances = ChurchAttendance::orderBy('start_date','desc')->get();
                    break;
                default:
                    $church_attendances = ChurchAttendance::orderBy('start_date','desc')->get();
            }
        }

        return view('modules.church_attendances.index', compact('church_attendances', 'week', 'existing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        if ($role == 'Supervisor') {
            $sector = Sector::where('user_id', $user_id)->first();
            $cells = Cell::where('sector_id', $sector->id)->orderBy('id','desc')->get();
        } else {
            $cells = Cell::where('user_leader_id', $user_id)->first();
            $sector = $cells->sector_id;
        }

        $church_attendance = new ChurchAttendance();
        $church_attendance['start_date'] = Carbon::now()->startOfWeek()->format('Y-m-d');
        $church_attendance['end_date'] = Carbon::now()->endOfWeek()->format('Y-m-d');

        return view('modules.church_attendances.create', compact('user_id', 'cells', 'church_attendance', 'role', 'sector'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChurchAttendanceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreChurchAttendanceRequest $request)
    {
        $validated_data = $request->validated();
        $user_id = Auth::id();
        $validated_data['user_id'] = $user_id;

        $start_date = $validated_data['start_date'];
        $end_date = $validated_data['end_date'];
        $formattedStartDate = Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
        $formattedEndDate = Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');
        $validated_data['start_date'] = $formattedStartDate;
        $validated_data['end_date'] = $formattedEndDate;

        ChurchAttendance::create($validated_data);

        return redirect()->route('church-attendances.index')->with('success','El registro ha sido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChurchAttendance  $churchAttendance
     * @return \Illuminate\View\View
     */
    public function show(ChurchAttendance $churchAttendance)
    {
        return view('modules.church_attendances.show',compact('churchAttendance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChurchAttendance  $church_attendance
     * @return \Illuminate\View\View
     */
    public function edit(ChurchAttendance $church_attendance)
    {
        $user_id = Auth::id();
        $cells = Cell::find($church_attendance->cell_id);
        $members = CellMember::where('cell_id', $church_attendance->cell_id)->whereHas('member', function ($query) {$query->where('status', 1);})->get();

        return view('modules.church_attendances.edit',compact('church_attendance', 'user_id', 'cells', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChurchAttendanceRequest  $request
     * @param  \App\Models\ChurchAttendance  $churchAttendance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateChurchAttendanceRequest $request, ChurchAttendance $churchAttendance)
    {
        $user_id = Auth::id();
        $validated_data = $request->validated();
        $validated_data['user_id'] = $user_id;

        $start_date = $validated_data['start_date'];
        $end_date = $validated_data['end_date'];
        $formattedStartDate = Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
        $formattedEndDate = Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');
        $validated_data['start_date'] = $formattedStartDate;
        $validated_data['end_date'] = $formattedEndDate;

        $churchAttendance->fill($validated_data)->save();

        return redirect()->route('church-attendances.index')->with('success','El registro ha sido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChurchAttendance  $churchAttendance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ChurchAttendance $churchAttendance)
    {
        $churchAttendance->delete();

        return redirect()->route('church-attendances.index')->with('success','El registro ha sido eliminado exitosamente');
    }
}
