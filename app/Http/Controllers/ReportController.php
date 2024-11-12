<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Http\Resources\ReportResource;
use App\Models\Cell;
use App\Models\CellAttendance;
use App\Models\CellMember;
use App\Models\District;
use App\Models\GoalControl;
use App\Models\Report;
use App\Models\Sector;
use App\Models\User;
use App\Models\Zone;
use App\Traits\DataFilterTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    use DataFilterTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cell_id = request('cell_id');
        $reports = $this->getReportData($cell_id);
        $cells = $this->getCells();
        $limit_date = Carbon::now()->subMonth()->toDate();
        // dd($limit_date);

        return view('modules.reports.index', compact('reports', 'cells', 'cell_id', 'limit_date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $role = auth()->user()->roles->pluck('name')[0];

        $districts = [];
        $zones = [];
        $sectors = [];
        $cells = [];
        $members = [];
        switch ($role) {
            case 'Líder':
                $cells = Cell::where('user_leader_id', $user_id)->first();
                $members = CellMember::where('cell_id', $cells->id)->whereHas('member', function ($query) {$query->where('status', 1);})->get();
              break;
            case 'Supervisor':
                $sectors = $user->sector;
                $cells = Cell::where('sector_id', $sectors->id)->get();
              break;
            case 'Pastor de Zona':
                $zones = $user->zone;
                $sectors = Sector::where('zone_id', $zones->id)->get();
              break;
            case 'Pastor de Distrito':
                $districts = $user->district;
                $zones = Zone::where('district_id', $districts->id)->get();
                break;
            default:
            $districts = District::all();
          }
        $report = new Report;
        $cell_attendance = new CellAttendance;

        return view('modules.reports.create', compact('user', 'districts', 'zones', 'sectors', 'cells', 'report', 'role', 'members', 'cell_attendance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReportRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreReportRequest $request)
    {
        $user_id = Auth::id();

        $request->validated();
        $attendance = request()->input('attendance');
        $cell_id = request()->input('cell_id');
        $total_attendance = request()->input('total_attendance');
        $validated_data = $request->safe()->except(['attendance']);

        $date = $validated_data['date'];
        $formattedDate = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');

        $validated_data['date'] = $formattedDate;
        $validated_data['user_id'] = $user_id;

        $report = Report::create($validated_data);
        $cell_attendance = new CellAttendance();
        $cell_attendance->report_id = $report->id;
        $cell_attendance->member_attendance = json_encode($attendance);
        $cell_attendance->save();

        GoalControl::where('cell_id', $cell_id)->update(['assistance' => $total_attendance]);

        return redirect()->route('reports.index')->with('success','El registro ha sido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\View\View
     */
    public function show(Report $report)
    {
        return view('modules.reports.show',compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\View\View
     */
    public function edit(Report $report)
    {
        $user = User::find(Auth::id());
        $cells = Cell::find($report->cell_id);
        $members = CellMember::where('cell_id', $report->cell_id)->whereHas('member', function ($query) {$query->where('status', 1);})->get();
        $cell_attendance = CellAttendance::where('report_id', $report->id)->first();
        $member_attendance = json_decode($cell_attendance->member_attendance);
        $cell_attendance['member_attendance'] = $member_attendance ?? [];
        return view('modules.reports.edit',compact('user', 'cells', 'report', 'members', 'cell_attendance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReportRequest  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        $user_id = Auth::id();

        $request->validated();
        $attendance = request()->input('attendance');
        $cell_id = request()->input('cell_id');
        $total_attendance = request()->input('total_attendance');
        $validated_data = $request->safe()->except(['attendance']);

        $date = $request->input('date');
        $formattedDate = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');

        $validated_data['date'] = $formattedDate;
        $validated_data['user_id'] = $user_id;

        $cell_attendance = CellAttendance::where('report_id',$report->id)->first();
        if (!isset($cell_attendance)) {
            $cell_attendance = new CellAttendance();
            $member_attendance['report_id'] = $report->id;
        }
        $member_attendance['member_attendance'] = json_encode($attendance);

        $report->fill($validated_data)->save();
        $cell_attendance->fill($member_attendance)->save();

        GoalControl::where('cell_id', $cell_id)->update(['assistance' => $total_attendance]);

        return redirect()->route('reports.index')->with('success','El registro ha sido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Report $report)
    {
        $attendance = CellAttendance::where('report_id', $report->id);
        $attendance->delete();
        $report->delete();
        return redirect()->route('reports.index')->with('success','El registro ha sido eliminado exitosamente');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function sectors()
    {
        $sector_id = request('sector_id');
        $date = request('date');
        $start_date = request('start_date');
        $end_date = request('end_date');
        $reports = [];
        $avg = '';

        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        if (!empty($date) || (!empty($start_date) && !empty($end_date))) {
            if (!empty($date)) {
                $_date = explode(' - ', $date);
                $start_date = Carbon::createFromFormat('d/m/Y', $_date[0])->format('Y-m-d');
                $end_date = Carbon::createFromFormat('d/m/Y', $_date[1])->format('Y-m-d');
            } else {
                $avg = true;
                $start_date = Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
                $end_date = Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');
            }

            if($sector_id){
                $cells = Cell::where('sector_id', $sector_id)->pluck('id');
                $reports = Report::whereBetween('date', [$start_date, $end_date])->whereIn('cell_id', $cells)->orderBy('id','desc')->get();
            } else {
                switch ($role) {
                    case 'Supervisor':
                        $sector = Sector::where('user_id', $user_id)->first();
                        $cells = Cell::where('sector_id', $sector->id)->pluck('id');
                        $reports = Report::whereBetween('date', [$start_date, $end_date])->whereIn('cell_id', $cells)->orderBy('id', 'desc')->get();
                        break;
                    case 'Pastor de Zona':
                        $zone = Zone::where('user_id', $user_id)->first();
                        $sector = Sector::where('zone_id', $zone->id)->pluck('id');
                        $cells = Cell::where('sector_id', $sector->id)->pluck('id');
                        $reports = Report::whereBetween('date', [$start_date, $end_date])->whereIn('cell_id', $cells)->orderBy('id','desc')->get();
                        break;
                    case 'Pastor de Distrito':
                        $district = District::where('user_id', $user_id)->first();
                        $zone = Zone::where('district_id', $district->id)->pluck('id');
                        $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                        $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                        $reports = Report::whereBetween('date', [$start_date, $end_date])->whereIn('cell_id', $cells)->orderBy('id','desc')->get();
                        break;
                    case 'Pastor General':
                    case 'Anciano':
                        $reports = Report::whereBetween('date', [$start_date, $end_date])->orderBy('id','desc')->get();
                        break;
                    default:
                        $reports = Report::whereBetween('date', [$start_date, $end_date])->orderBy('id','desc')->get();
                }
            }

            $result = [
                'total_adult_leader' => $reports->sum(function ($report){ return $report->cell->type == 'Adultos' ? 1 : 0;}),
                'total_youth_leader' => $reports->sum(function ($report){ return $report->cell->type == 'Jóvenes' ? 1 : 0;}),
                'total_children_leader' => $reports->sum(function ($report){ return $report->cell->type == 'Niños' ? 1 : 0;}),
                'adult_sibling_attendance' => $reports->sum('adult_sibling_attendance'),
                'adult_friends_attendance' => $reports->sum('adult_friends_attendance'),
                'total_adult_attendance' => $reports->sum('total_adult_attendance'),
                'youth_sibling_attendance' => $reports->sum('youth_sibling_attendance'),
                'youth_friends_attendance' => $reports->sum('youth_friends_attendance'),
                'total_youth_attendance' => $reports->sum('total_youth_attendance'),
                'children_sibling_attendance' => $reports->sum('children_sibling_attendance'),
                'children_friends_attendance' => $reports->sum('children_friends_attendance'),
                'total_children_attendance' => $reports->sum('total_children_attendance'),
                'total_attendance' => $reports->sum('total_attendance'),
                'total_church_offering' => $reports->sum('church_offering'),
                'total_pro_bus_offering' => $reports->sum('pro_bus_offering'),
                'total_offering_meter_by_meter' => $reports->sum('offering_meter_by_meter'),
                'total_conversions' => $reports->sum('conversions'),
                'total_reconciliations' => $reports->sum('reconciliations')
            ];

            $sum_reports = collect($result)->sortBy('full_code')->toArray();
        } else {
            $sum_reports = [];
        }

        $sectors = $this->getSectors();
        return view('modules.reports.sectors', compact('reports','sum_reports', 'sectors', 'sector_id', 'date', 'start_date', 'end_date', 'avg'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function zones()
    {
        $zone_id = request('zone_id');
        $date = request('date');
        $start_date = request('start_date');
        $end_date = request('end_date');

        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];
        $zones = $this->getZones();

        if (!empty($date) || (!empty($start_date) && !empty($end_date))) {
            if (!empty($date)) {
                $_date = explode(' - ', $date);
                $start_date = Carbon::createFromFormat('d/m/Y', $_date[0])->format('Y-m-d');
                $end_date = Carbon::createFromFormat('d/m/Y', $_date[1])->format('Y-m-d');
            } else {
                $start_date = Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
                $end_date = Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');
            }

            if($zone_id) {
                $sectors = Sector::where('zone_id', $zone_id)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sectors)->pluck('id');
                $reports = Report::whereBetween('date', [$start_date, $end_date])->whereIn('cell_id', $cells)->orderBy('id','desc')->get();
            } else {
                switch ($role) {
                    case 'Pastor de Zona':
                        $zone = Zone::where('user_id', $user_id)->first();
                        $sectors = Sector::where('zone_id', $zone->id)->pluck('id');
                        $cells = Cell::whereIn('sector_id', $sectors)->pluck('id');
                        $reports = Report::whereBetween('date', [$start_date, $end_date])->whereIn('cell_id', $cells)->orderBy('id','desc')->get();
                        break;
                    case 'Pastor de Distrito':
                        $district = District::where('user_id', $user_id)->first();
                        $zones = Zone::where('district_id', $district->id)->pluck('id');
                        $sectors = Sector::whereIn('zone_id', $zones)->pluck('id');
                        $cells = Cell::whereIn('sector_id', $sectors)->pluck('id');
                        $reports = Report::whereBetween('date', [$start_date, $end_date])->whereIn('cell_id', $cells)->orderBy('id','desc')->get();
                        break;
                    case 'Pastor General':
                    case 'Anciano':
                        $reports = Report::orderBy('id','desc')->get();
                        break;
                    default:
                        $reports = Report::orderBy('id','desc')->get();
                }
            }

            $grouped_reports = $reports->groupBy(function ($report) {
                return $report->cell->sector->id;
            })->map(function ($reports) {
                $sector = $reports->first()->cell->sector;
                $full_code = $sector->full_code;
                $supervisor = $sector->user->member->full_name;
                $total_adult_leader = $reports->sum(function ($report){
                    return $report->cell->type == 'Adultos' ? 1 : 0;
                });
                $total_youth_leader = $reports->sum(function ($report){
                    return $report->cell->type == 'Jóvenes' ? 1 : 0;
                });
                $total_children_leader = $reports->sum(function ($report){
                    return $report->cell->type == 'Niños' ? 1 : 0;
                });
                $total_leaders = $reports->sum(function ($report){
                    return $report->cell ? 1 : 0;
                });
                $adult_sibling_attendance = $reports->sum(function ($report) {
                    return $report->adult_sibling_attendance;
                });
                $adult_friends_attendance = $reports->sum(function ($report) {
                    return $report->adult_friends_attendance;
                });
                $total_adult_attendance = $reports->sum(function ($report) {
                    return $report->total_adult_attendance;
                });
                $youth_sibling_attendance = $reports->sum(function ($report) {
                    return $report->youth_sibling_attendance;
                });
                $youth_friends_attendance = $reports->sum(function ($report) {
                    return $report->youth_friends_attendance;
                });
                $total_youth_attendance = $reports->sum(function ($report) {
                    return $report->total_youth_attendance;
                });
                $children_sibling_attendance = $reports->sum(function ($report) {
                    return $report->children_sibling_attendance;
                });
                $children_friends_attendance = $reports->sum(function ($report) {
                    return $report->children_friends_attendance;
                });
                $total_children_attendance = $reports->sum(function ($report) {
                    return $report->total_children_attendance;
                });
                $total_attendance = $reports->sum(function ($report) {
                    return $report->total_attendance;
                });
                $church_offering = $reports->sum(function ($report) {
                    return $report->church_offering;
                });
                $pro_bus_offering = $reports->sum(function ($report) {
                    return $report->pro_bus_offering;
                });
                $offering_meter_by_meter = $reports->sum(function ($report) {
                    return $report->offering_meter_by_meter;
                });
                $conversions = $reports->sum(function ($report) {
                    return $report->conversions;
                });
                $reconciliations = $reports->sum(function ($report) {
                    return $report->reconciliations;
                });
                return [
                    'full_code' => $full_code,
                    'supervisor' => $supervisor,
                    'total_adult_leader' => $total_adult_leader,
                    'total_youth_leader' => $total_youth_leader,
                    'total_children_leader' => $total_children_leader,
                    'total_leaders' => $total_leaders,
                    'adult_sibling_attendance' => $adult_sibling_attendance,
                    'adult_friends_attendance' => $adult_friends_attendance,
                    'total_adult_attendance' => $total_adult_attendance,
                    'youth_sibling_attendance' => $youth_sibling_attendance,
                    'youth_friends_attendance' => $youth_friends_attendance,
                    'total_youth_attendance' => $total_youth_attendance,
                    'children_sibling_attendance' => $children_sibling_attendance,
                    'children_friends_attendance' => $children_friends_attendance,
                    'total_children_attendance' => $total_children_attendance,
                    'total_attendance' => $total_attendance,
                    'church_offering' => $church_offering,
                    'pro_bus_offering' => $pro_bus_offering,
                    'offering_meter_by_meter' => $offering_meter_by_meter,
                    'conversions' => $conversions,
                    'reconciliations' => $reconciliations,
                ];
            })->sortBy('full_code');

            $sum_reports = [
                'total_adult_leader' => $grouped_reports->sum('total_adult_leader'),
                'total_youth_leader' => $grouped_reports->sum('total_youth_leader'),
                'total_children_leader' => $grouped_reports->sum('total_children_leader'),
                'total_leaders' => $grouped_reports->sum('total_leaders'),
                'adult_sibling_attendance' => $grouped_reports->sum('adult_sibling_attendance'),
                'adult_friends_attendance' => $grouped_reports->sum('adult_friends_attendance'),
                'total_adult_attendance' => $grouped_reports->sum('total_adult_attendance'),
                'youth_sibling_attendance' => $grouped_reports->sum('youth_sibling_attendance'),
                'youth_friends_attendance' => $grouped_reports->sum('youth_friends_attendance'),
                'total_youth_attendance' => $grouped_reports->sum('total_youth_attendance'),
                'children_sibling_attendance' => $grouped_reports->sum('children_sibling_attendance'),
                'children_friends_attendance' => $grouped_reports->sum('children_friends_attendance'),
                'total_children_attendance' => $grouped_reports->sum('total_children_attendance'),
                'total_attendance' => $grouped_reports->sum('total_attendance'),
                'total_church_offering' => $grouped_reports->sum('church_offering'),
                'total_pro_bus_offering' => $grouped_reports->sum('pro_bus_offering'),
                'total_offering_meter_by_meter' => $grouped_reports->sum('offering_meter_by_meter'),
                'total_conversions' => $grouped_reports->sum('conversions'),
                'total_reconciliations' => $grouped_reports->sum('reconciliations')
            ];

            return view('modules.reports.zones', compact('grouped_reports', 'zones', 'zone_id', 'date', 'sum_reports', 'start_date', 'end_date'));
        } else {
            $grouped_reports = [];
            return view('modules.reports.zones', compact('grouped_reports', 'zones', 'zone_id', 'date', 'start_date', 'end_date'));
        }
    }

    public function districts()
    {
        $district_id = request('district_id');
        $date = request('date');
        $start_date = '';
        $end_date = '';

        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];
        $districts = $this->getDistrict();

        if (!empty($date)) {
            $_date = explode(' - ', $date);
            $start_date = Carbon::createFromFormat('d/m/Y', $_date[0])->format('Y-m-d');
            $end_date = Carbon::createFromFormat('d/m/Y', $_date[1])->format('Y-m-d');

            if($district_id) {
                $zones = Zone::where('district_id', $district_id)->pluck('id');
                $sectors = Sector::whereIn('zone_id', $zones)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sectors)->pluck('id');
                $reports = Report::whereBetween('date', [$start_date, $end_date])->whereIn('cell_id', $cells)->orderBy('id','desc')->get();
            } else {
                switch ($role) {
                    case 'Pastor de Distrito':
                        $district = District::where('user_id', $user_id)->first();
                        $zones = Zone::where('district_id', $district->id)->pluck('id');
                        $sectors = Sector::whereIn('zone_id', $zones)->pluck('id');
                        $cells = Cell::whereIn('sector_id', $sectors)->pluck('id');
                        $reports = Report::whereBetween('date', [$start_date, $end_date])->whereIn('cell_id', $cells)->orderBy('id','desc')->get();
                        break;
                    case 'Pastor General':
                    case 'Anciano':
                        $reports = Report::orderBy('id','desc')->get();
                        break;
                    default:
                        $reports = Report::orderBy('id','desc')->get();
                }
            }

            $grouped_reports = $reports->groupBy(function ($report) {
                return $report->cell->sector->zone->id;
            })->map(function ($reports) {
                $zone = $reports->first()->cell->sector->zone;
                $full_code = $zone->full_code;
                $pastor = $zone->user->member->full_name;
                $total_adult_leader = $reports->sum(function ($report){
                    return $report->cell->type == 'Adultos' ? 1 : 0;
                });
                $total_youth_leader = $reports->sum(function ($report){
                    return $report->cell->type == 'Jóvenes' ? 1 : 0;
                });
                $total_children_leader = $reports->sum(function ($report){
                    return $report->cell->type == 'Niños' ? 1 : 0;
                });
                $total_leaders = $reports->sum(function ($report){
                    return $report->cell ? 1 : 0;
                });
                $adult_sibling_attendance = $reports->sum(function ($report) {
                    return $report->adult_sibling_attendance;
                });
                $adult_friends_attendance = $reports->sum(function ($report) {
                    return $report->adult_friends_attendance;
                });
                $total_adult_attendance = $reports->sum(function ($report) {
                    return $report->total_adult_attendance;
                });
                $youth_sibling_attendance = $reports->sum(function ($report) {
                    return $report->youth_sibling_attendance;
                });
                $youth_friends_attendance = $reports->sum(function ($report) {
                    return $report->youth_friends_attendance;
                });
                $total_youth_attendance = $reports->sum(function ($report) {
                    return $report->total_youth_attendance;
                });
                $children_sibling_attendance = $reports->sum(function ($report) {
                    return $report->children_sibling_attendance;
                });
                $children_friends_attendance = $reports->sum(function ($report) {
                    return $report->children_friends_attendance;
                });
                $total_children_attendance = $reports->sum(function ($report) {
                    return $report->total_children_attendance;
                });
                $total_attendance = $reports->sum(function ($report) {
                    return $report->total_attendance;
                });
                $church_offering = $reports->sum(function ($report) {
                    return $report->church_offering;
                });
                $pro_bus_offering = $reports->sum(function ($report) {
                    return $report->pro_bus_offering;
                });
                $offering_meter_by_meter = $reports->sum(function ($report) {
                    return $report->offering_meter_by_meter;
                });
                $conversions = $reports->sum(function ($report) {
                    return $report->conversions;
                });
                $reconciliations = $reports->sum(function ($report) {
                    return $report->reconciliations;
                });
                return [
                    'full_code' => $full_code,
                    'pastor' => $pastor,
                    'total_adult_leader' => $total_adult_leader,
                    'total_youth_leader' => $total_youth_leader,
                    'total_children_leader' => $total_children_leader,
                    'total_leaders' => $total_leaders,
                    'adult_sibling_attendance' => $adult_sibling_attendance,
                    'adult_friends_attendance' => $adult_friends_attendance,
                    'total_adult_attendance' => $total_adult_attendance,
                    'youth_sibling_attendance' => $youth_sibling_attendance,
                    'youth_friends_attendance' => $youth_friends_attendance,
                    'total_youth_attendance' => $total_youth_attendance,
                    'children_sibling_attendance' => $children_sibling_attendance,
                    'children_friends_attendance' => $children_friends_attendance,
                    'total_children_attendance' => $total_children_attendance,
                    'total_attendance' => $total_attendance,
                    'church_offering' => $church_offering,
                    'pro_bus_offering' => $pro_bus_offering,
                    'offering_meter_by_meter' => $offering_meter_by_meter,
                    'conversions' => $conversions,
                    'reconciliations' => $reconciliations,
                ];
            })->sortBy('full_code');

            $sum_reports = [
                'total_adult_leader' => $grouped_reports->sum('total_adult_leader'),
                'total_youth_leader' => $grouped_reports->sum('total_youth_leader'),
                'total_children_leader' => $grouped_reports->sum('total_children_leader'),
                'total_leaders' => $grouped_reports->sum('total_leaders'),
                'adult_sibling_attendance' => $grouped_reports->sum('adult_sibling_attendance'),
                'adult_friends_attendance' => $grouped_reports->sum('adult_friends_attendance'),
                'total_adult_attendance' => $grouped_reports->sum('total_adult_attendance'),
                'youth_sibling_attendance' => $grouped_reports->sum('youth_sibling_attendance'),
                'youth_friends_attendance' => $grouped_reports->sum('youth_friends_attendance'),
                'total_youth_attendance' => $grouped_reports->sum('total_youth_attendance'),
                'children_sibling_attendance' => $grouped_reports->sum('children_sibling_attendance'),
                'children_friends_attendance' => $grouped_reports->sum('children_friends_attendance'),
                'total_children_attendance' => $grouped_reports->sum('total_children_attendance'),
                'total_attendance' => $grouped_reports->sum('total_attendance'),
                'total_church_offering' => $grouped_reports->sum('church_offering'),
                'total_pro_bus_offering' => $grouped_reports->sum('pro_bus_offering'),
                'total_offering_meter_by_meter' => $grouped_reports->sum('offering_meter_by_meter'),
                'total_conversions' => $grouped_reports->sum('conversions'),
                'total_reconciliations' => $grouped_reports->sum('reconciliations')
            ];

            return view('modules.reports.districts', compact('grouped_reports', 'districts', 'district_id', 'date', 'sum_reports'));
        } else {
            $grouped_reports = [];

            return view('modules.reports.districts', compact('grouped_reports', 'districts', 'district_id', 'date'));
        }

    }
    public function general()
    {
        $date = request('date');
        $start_date = '';
        $end_date = '';

        if (!empty($date)) {
            $_date = explode(' - ', $date);
            $start_date = Carbon::createFromFormat('d/m/Y', $_date[0])->format('Y-m-d');
            $end_date = Carbon::createFromFormat('d/m/Y', $_date[1])->format('Y-m-d');

            $districts = District::all()->except([10]);

            $grouped_reports = [];

            foreach ($districts as $district) {
                $reports = Report::whereBetween('date', [$start_date, $end_date])
                    ->whereHas('cell.sector.zone.district', function ($query) use ($district) {
                        $query->where('id', $district->id);
                    })
                    ->orderBy('id', 'desc')
                    ->get();

                $district_info = [
                    'full_code' => $district->full_code,
                    'pastor' => $district->user ? $district->user->member->full_name : '',
                    'total_adult_leader' => 0,
                    'total_youth_leader' => 0,
                    'total_children_leader' => 0,
                    'total_leaders' => 0,
                    'adult_sibling_attendance' => 0,
                    'adult_friends_attendance' => 0,
                    'total_adult_attendance' => 0,
                    'youth_sibling_attendance' => 0,
                    'youth_friends_attendance' => 0,
                    'total_youth_attendance' => 0,
                    'children_sibling_attendance' => 0,
                    'children_friends_attendance' => 0,
                    'total_children_attendance' => 0,
                    'total_attendance' => 0,
                    'church_offering' => 0,
                    'pro_bus_offering' => 0,
                    'offering_meter_by_meter' => 0,
                    'conversions' => 0,
                    'reconciliations' => 0,
                ];

                foreach ($reports as $report) {
                    $district_info['total_adult_leader'] += $report->cell->type == 'Adultos' ? 1 : 0;
                    $district_info['total_youth_leader'] += $report->cell->type == 'Jóvenes' ? 1 : 0;
                    $district_info['total_children_leader'] += $report->cell->type == 'Niños' ? 1 : 0;
                    $district_info['total_leaders'] += $report->cell ? 1 : 0;
                    $district_info['adult_sibling_attendance'] += $report->adult_sibling_attendance;
                    $district_info['adult_friends_attendance'] += $report->adult_friends_attendance;
                    $district_info['total_adult_attendance'] += $report->total_adult_attendance;
                    $district_info['youth_sibling_attendance'] += $report->youth_sibling_attendance;
                    $district_info['youth_friends_attendance'] += $report->youth_friends_attendance;
                    $district_info['total_youth_attendance'] += $report->total_youth_attendance;
                    $district_info['children_sibling_attendance'] += $report->children_sibling_attendance;
                    $district_info['children_friends_attendance'] += $report->children_friends_attendance;
                    $district_info['total_children_attendance'] += $report->total_children_attendance;
                    $district_info['total_attendance'] += $report->total_attendance;
                    $district_info['church_offering'] += $report->church_offering;
                    $district_info['pro_bus_offering'] += $report->pro_bus_offering;
                    $district_info['offering_meter_by_meter'] += $report->offering_meter_by_meter;
                    $district_info['conversions'] += $report->conversions;
                    $district_info['reconciliations'] += $report->reconciliations;
                }

                $grouped_reports[] = $district_info;
            }

            $sum_reports = [
                'total_adult_leader' => array_sum(array_column($grouped_reports, 'total_adult_leader')),
                'total_youth_leader' => array_sum(array_column($grouped_reports, 'total_youth_leader')),
                'total_children_leader' => array_sum(array_column($grouped_reports, 'total_children_leader')),
                'total_leaders' => array_sum(array_column($grouped_reports, 'total_leaders')),
                'adult_sibling_attendance' => array_sum(array_column($grouped_reports, 'adult_sibling_attendance')),
                'adult_friends_attendance' => array_sum(array_column($grouped_reports, 'adult_friends_attendance')),
                'total_adult_attendance' => array_sum(array_column($grouped_reports, 'total_adult_attendance')),
                'youth_sibling_attendance' => array_sum(array_column($grouped_reports, 'youth_sibling_attendance')),
                'youth_friends_attendance' => array_sum(array_column($grouped_reports, 'youth_friends_attendance')),
                'total_youth_attendance' => array_sum(array_column($grouped_reports, 'total_youth_attendance')),
                'children_sibling_attendance' => array_sum(array_column($grouped_reports, 'children_sibling_attendance')),
                'children_friends_attendance' => array_sum(array_column($grouped_reports, 'children_friends_attendance')),
                'total_children_attendance' => array_sum(array_column($grouped_reports, 'total_children_attendance')),
                'total_attendance' => array_sum(array_column($grouped_reports, 'total_attendance')),
                'total_church_offering' => array_sum(array_column($grouped_reports, 'church_offering')),
                'total_pro_bus_offering' => array_sum(array_column($grouped_reports, 'pro_bus_offering')),
                'total_offering_meter_by_meter' => array_sum(array_column($grouped_reports, 'offering_meter_by_meter')),
                'total_conversions' => array_sum(array_column($grouped_reports, 'conversions')),
                'total_reconciliations' => array_sum(array_column($grouped_reports, 'reconciliations')),
            ];

            return view('modules.reports.general', compact('grouped_reports', 'date', 'sum_reports'));
        } else {
            $grouped_reports = [];
            return view('modules.reports.general', compact('grouped_reports', 'date'));
        }
    }
    public function statGeneral()
    {
        $date = request('date');
        $start_date = '';
        $end_date = '';

        if (!empty($date)) {
            $_date = explode(' - ', $date);
            $start_date = Carbon::createFromFormat('d/m/Y', $_date[0])->format('Y-m-d');
            $end_date = Carbon::createFromFormat('d/m/Y', $_date[1])->format('Y-m-d');

            $districts = District::all()->except([10]);

            $grouped_reports = [];

            foreach ($districts as $district) {
                $reports = Report::whereBetween('date', [$start_date, $end_date])
                    ->whereHas('cell.sector.zone.district', function ($query) use ($district) {
                        $query->where('id', $district->id);
                    })
                    ->orderBy('id', 'desc')
                    ->get();

                $district_info = [
                    'full_code' => $district->full_code,
                    'pastor' => $district->user ? $district->user->member->full_name : '',
                    'total_adult_leader' => 0,
                    'total_youth_leader' => 0,
                    'total_children_leader' => 0,
                    'total_leaders' => 0,
                    'adult_sibling_attendance' => 0,
                    'adult_friends_attendance' => 0,
                    'total_adult_attendance' => 0,
                    'youth_sibling_attendance' => 0,
                    'youth_friends_attendance' => 0,
                    'total_youth_attendance' => 0,
                    'children_sibling_attendance' => 0,
                    'children_friends_attendance' => 0,
                    'total_children_attendance' => 0,
                    'total_attendance' => 0,
                    'church_offering' => 0,
                    'pro_bus_offering' => 0,
                    'offering_meter_by_meter' => 0,
                    'conversions' => 0,
                    'reconciliations' => 0,
                ];

                foreach ($reports as $report) {
                    $district_info['total_adult_leader'] += $report->cell->type == 'Adultos' ? 1 : 0;
                    $district_info['total_youth_leader'] += $report->cell->type == 'Jóvenes' ? 1 : 0;
                    $district_info['total_children_leader'] += $report->cell->type == 'Niños' ? 1 : 0;
                    $district_info['total_leaders'] += $report->cell ? 1 : 0;
                    $district_info['adult_sibling_attendance'] += $report->adult_sibling_attendance;
                    $district_info['adult_friends_attendance'] += $report->adult_friends_attendance;
                    $district_info['total_adult_attendance'] += $report->total_adult_attendance;
                    $district_info['youth_sibling_attendance'] += $report->youth_sibling_attendance;
                    $district_info['youth_friends_attendance'] += $report->youth_friends_attendance;
                    $district_info['total_youth_attendance'] += $report->total_youth_attendance;
                    $district_info['children_sibling_attendance'] += $report->children_sibling_attendance;
                    $district_info['children_friends_attendance'] += $report->children_friends_attendance;
                    $district_info['total_children_attendance'] += $report->total_children_attendance;
                    $district_info['total_attendance'] += $report->total_attendance;
                    $district_info['church_offering'] += $report->church_offering;
                    $district_info['pro_bus_offering'] += $report->pro_bus_offering;
                    $district_info['offering_meter_by_meter'] += $report->offering_meter_by_meter;
                    $district_info['conversions'] += $report->conversions;
                    $district_info['reconciliations'] += $report->reconciliations;
                }

                $grouped_reports[] = $district_info;
            }

            $sum_reports = [
                'total_adult_leader' => array_sum(array_column($grouped_reports, 'total_adult_leader')),
                'total_youth_leader' => array_sum(array_column($grouped_reports, 'total_youth_leader')),
                'total_children_leader' => array_sum(array_column($grouped_reports, 'total_children_leader')),
                'total_leaders' => array_sum(array_column($grouped_reports, 'total_leaders')),
                'adult_sibling_attendance' => array_sum(array_column($grouped_reports, 'adult_sibling_attendance')),
                'adult_friends_attendance' => array_sum(array_column($grouped_reports, 'adult_friends_attendance')),
                'total_adult_attendance' => array_sum(array_column($grouped_reports, 'total_adult_attendance')),
                'youth_sibling_attendance' => array_sum(array_column($grouped_reports, 'youth_sibling_attendance')),
                'youth_friends_attendance' => array_sum(array_column($grouped_reports, 'youth_friends_attendance')),
                'total_youth_attendance' => array_sum(array_column($grouped_reports, 'total_youth_attendance')),
                'children_sibling_attendance' => array_sum(array_column($grouped_reports, 'children_sibling_attendance')),
                'children_friends_attendance' => array_sum(array_column($grouped_reports, 'children_friends_attendance')),
                'total_children_attendance' => array_sum(array_column($grouped_reports, 'total_children_attendance')),
                'total_attendance' => array_sum(array_column($grouped_reports, 'total_attendance')),
                'total_church_offering' => array_sum(array_column($grouped_reports, 'church_offering')),
                'total_pro_bus_offering' => array_sum(array_column($grouped_reports, 'pro_bus_offering')),
                'total_offering_meter_by_meter' => array_sum(array_column($grouped_reports, 'offering_meter_by_meter')),
                'total_conversions' => array_sum(array_column($grouped_reports, 'conversions')),
                'total_reconciliations' => array_sum(array_column($grouped_reports, 'reconciliations')),
            ];

            return view('modules.reports.stat_general', compact('grouped_reports', 'date', 'sum_reports'));
        } else {
            $grouped_reports = [];
            return view('modules.reports.stat_general', compact('grouped_reports', 'date'));
        }
    }

    public function graphShow()
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        switch ($role) {
            case 'Líder':
                $cell = Cell::where('user_leader_id', $user_id)->first();
                $report = Report::where('cell_id', $cell->id)->orderBy('date','desc')->first();
                break;
            case 'Supervisor':
                $sector = Sector::where('user_id', $user_id)->first();
                $cells = Cell::where('sector_id', $sector->id)->pluck('id');
                $report = Report::whereIn('cell_id', $cells)->orderBy('date','desc')->first();
                break;
            case 'Pastor de Zona':
                $zone = Zone::where('user_id', $user_id)->first();
                $sector = Sector::where('zone_id', $zone->id)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                $report = Report::whereIn('cell_id', $cells)->orderBy('id','desc')->first();
                break;
            case 'Pastor de Distrito':
                $district = District::where('user_id', $user_id)->first();
                $zone = Zone::where('district_id', $district->id)->pluck('id');
                $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                $report = Report::whereIn('cell_id', $cells)->orderBy('id','desc')->first();
                break;
            case 'Pastor General':
            case 'Anciano':
                $report = Report::orderBy('id','desc')->first();
                break;
            default:
                $report = Report::orderBy('id','desc')->first();
        }

        return ReportResource::make($report);
    }

    public function attendance()
    {
        $start_week = Carbon::now()->subWeek()->startOfWeek();
        $end_week   = Carbon::now()->subWeek()->endOfWeek();
        $response = [];
        $dates = [];
        $attendance = [];
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        switch ($role) {
            case 'Líder':
                $cell = Cell::where('user_leader_id', $user_id)->first();
                break;
            case 'Supervisor':
                $sector = Sector::where('user_id', $user_id)->first();
                $cells = Cell::where('sector_id', $sector->id)->pluck('id');
                break;
            case 'Pastor de Zona':
                $zone = Zone::where('user_id', $user_id)->first();
                $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                break;
            case 'Pastor de Distrito':
                $district = District::where('user_id', $user_id)->first();
                $zone = Zone::where('district_id', $district->id)->pluck('id');
                $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                break;
            case 'Pastor General':
            case 'Anciano':
                $cells = Cell::pluck('id');
                break;
            default:
                $cells = Cell::pluck('id');
        }

        if (!empty($cell)) {
            $data = Report::where('cell_id', $cell->id)
                    ->whereBetween('date',[ $start_week,$end_week ])->first();
            $total_adult_attendance = $data['total_adult_attendance'] ?? 0;
            $total_youth_attendance = $data['total_youth_attendance'] ?? 0;
            $total_children_attendance = $data['total_children_attendance'] ?? 0;

            $graph = Report::where('cell_id', $cell->id)->orderBy('date', 'desc')->take(12)->get();
            foreach($graph as $r) {
                $s_week = Carbon::createFromDate($r->date)->startOfWeek()->format('d/M');
                $e_week = Carbon::createFromDate($r->date)->endOfWeek()->format('d/M');
                array_push($dates, $s_week . '-' . $e_week);
                array_push($attendance, $r->total_attendance);
            }
        } else {
            $data = Report::whereIn('cell_id', $cells)
                    ->whereBetween('date',[ $start_week,$end_week ])->get();
            $total_adult_attendance = $data->sum('total_adult_attendance') ?? 0;
            $total_youth_attendance = $data->sum('total_youth_attendance') ?? 0;
            $total_children_attendance = $data->sum('total_children_attendance') ?? 0;

            $graph = Report::whereIn('cell_id', $cells)->orderBy('date', 'desc')->take(12)->get();
            foreach($graph as $r) {
                $s_week = Carbon::createFromDate($r->date)->startOfWeek()->format('d/M');
                $e_week = Carbon::createFromDate($r->date)->endOfWeek()->format('d/M');
                array_push($dates, $s_week . '-' . $e_week);
                array_push($attendance, $r->total_attendance);
            }
        }

        $response['dates'] = array_reverse($dates);
        $response['attendance'] = array_reverse($attendance);
        $response['assistance'] = [$total_adult_attendance,$total_youth_attendance,$total_children_attendance];

        return $response;
    }

}
