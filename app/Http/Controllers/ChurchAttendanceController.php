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

        if (!empty($week)) {
            $dates = explode(' - ', $week);
            $start_date = Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d');
            $end_date = Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d');
            switch ($role) {
                case 'Supervisor':
                    $sector = Sector::where('user_id', $user_id)->first();
                    $cells = Cell::where('sector_id', $sector->id)->pluck('id');
                    $church_attendances = ChurchAttendance::where('start_date', $start_date)->where('end_date', $end_date)->whereIn('cell_id', $cells)->orderBy('start_date','desc')->get();
                    break;
                case 'Pastor de Zona':
                    $zone = Zone::where('user_id', $user_id)->first();
                    $sector = Sector::where('zone_id', $zone->id)->pluck('id');
                    $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                    $church_att = ChurchAttendance::where('start_date', $start_date)->where('end_date', $end_date)->whereIn('cell_id', $cells)->orderBy('start_date','desc')->get();

                    $church_attendances = $church_att->groupBy(function ($attendance) {
                        return $attendance->cell->sector->id;
                    })->map(function ($attendances, $sector_id) {
                        $sector = $attendances->first()->cell->sector;
                        $full_code = $sector->full_code;
                        $supervisor = $sector->user->member->full_name;
                        $sibling_attendance_1d = $attendances->sum(function ($attendance) {
                            return $attendance->sibling_attendance_1d;
                        });
                        $friends_attendance_1d = $attendances->sum(function ($attendance) {
                            return $attendance->friends_attendance_1d;
                        });
                        $total_attendance_1d = $attendances->sum(function ($attendance) {
                            return $attendance->total_attendance_1d;
                        });
                        $sibling_attendance_2d = $attendances->sum(function ($attendance) {
                            return $attendance->sibling_attendance_2d;
                        });
                        $friends_attendance_2d = $attendances->sum(function ($attendance) {
                            return $attendance->friends_attendance_2d;
                        });
                        $total_attendance_2d = $attendances->sum(function ($attendance) {
                            return $attendance->total_attendance_2d;
                        });
                        $sibling_attendance_sd = $attendances->sum(function ($attendance) {
                            return $attendance->sibling_attendance_sd;
                        });
                        $friends_attendance_sd = $attendances->sum(function ($attendance) {
                            return $attendance->friends_attendance_sd;
                        });
                        $total_attendance_sd = $attendances->sum(function ($attendance) {
                            return $attendance->total_attendance_sd;
                        });
                        $total_attendance_week = $attendances->sum(function ($attendance) {
                            return $attendance->total_attendance_week;
                        });
                        return [
                            'full_code' => $full_code,
                            'supervisor' => $supervisor,
                            'sibling_attendance_1d' => $sibling_attendance_1d,
                            'friends_attendance_1d' => $friends_attendance_1d,
                            'total_attendance_1d' => $total_attendance_1d,
                            'sibling_attendance_2d' => $sibling_attendance_2d,
                            'friends_attendance_2d' => $friends_attendance_2d,
                            'total_attendance_2d' => $total_attendance_2d,
                            'sibling_attendance_sd' => $sibling_attendance_sd,
                            'friends_attendance_sd' => $friends_attendance_sd,
                            'total_attendance_sd' => $total_attendance_sd,
                            'total_attendance_week' => $total_attendance_week,
                        ];
                    })->sortBy('full_code');

                    break;
                case 'Pastor de Distrito':
                    $district = District::where('user_id', $user_id)->first();
                    $zone = Zone::where('district_id', $district->id)->pluck('id');
                    $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                    $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                    $church_attendances = ChurchAttendance::whereIn('cell_id', $cells)->orderBy('start_date','desc')->get();
                    break;
                case 'Pastor General':
                case 'Anciano':
                    $church_attendances = ChurchAttendance::orderBy('start_date','desc')->get();
                    break;
                default:
                    $church_attendances = ChurchAttendance::orderBy('start_date','desc')->get();
            }
        } elseif ($role == 'Líder') {
            $cell = Cell::where('user_leader_id', $user_id)->first();
            $church_attendances = ChurchAttendance::where('cell_id', $cell->id)->orderBy('start_date','desc')->limit(1)->get();
        }

        return view('modules.church_attendances.index', compact('church_attendances', 'week'));
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
        $now = Carbon::now();
        $church_attendance['start_date'] = $now->startOfWeek()->format('Y-m-d');
        $church_attendance['end_date'] = $now->endOfWeek()->format('Y-m-d');

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
     * @param  \App\Models\ChurchAttendance  $churchAttendance
     * @return \Illuminate\View\View
     */
    public function edit(ChurchAttendance $churchAttendance)
    {
        $user_id = Auth::id();
        $cells = Cell::find($churchAttendance->cell_id);
        $members = CellMember::where('cell_id', $churchAttendance->cell_id)->whereHas('member', function ($query) {$query->where('status', 1);})->get();
        $church_attendance = $churchAttendance;

        return view('modules.church_attendances.edit',compact('church_attendance', 'user_id', 'cells', 'churchAttendance', 'members'));
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