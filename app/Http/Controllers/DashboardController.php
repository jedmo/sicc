<?php

namespace App\Http\Controllers;

use App\Models\Cell;
use App\Models\CellMember;
use App\Models\District;
use App\Models\Event;
use App\Models\Goal;
use App\Models\GoalControl;
use App\Models\Member;
use App\Models\Report;
use App\Models\Sector;
use App\Models\Zone;
use App\Traits\DataFilterTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {

    use DataFilterTrait;
    /**
     * Display dashboard demo one of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function home(){
        $title = "Inicio";
        $description = "Panel de inicio";

        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];
        $last_week_data = $this->getLastWeekData($user_id, $role);

        $e_date = Carbon::parse($last_week_data['events'][0]->start_date);
        $q = now()->diffInDays($e_date, false);
        $n_event = $last_week_data['events'][0];

        return view('pages.dashboard.index',compact('title','description','last_week_data', 'n_event', 'q'));
    }

    public function getLastWeekData($user_id, $role)
    {
        $startWeek = Carbon::now()->subWeek()->startOfWeek();
        $endWeek   = Carbon::now()->subWeek()->endOfWeek();
        $g_events = Event::where('type', 'general')->whereDate('start_date', '>=', Carbon::now())->get();
        $z_events = [];
        $d_events = [];

        switch ($role) {
            case 'Líder':
                $cell = Cell::where('user_leader_id', $user_id)->first();
                $sector = Sector::find($cell['sector_id']);
                $z_events = Event::where('zone_id', $sector['zone_id'])->where('type', 'zona')->whereDate('start_date', '>=', Carbon::now())->get();
                $zone = Zone::find($sector['zone_id'])->first();
                $d_events = Event::where('zone_id', '')->where('type', 'distrito')->where('district_id', $zone['district_id'])->whereDate('start_date', '>=', Carbon::now())->get();
                break;
            case 'Supervisor':
                $sector = Sector::where('user_id', $user_id)->first();
                $cells = Cell::where('sector_id', $sector->id)->pluck('id');
                $z_events = Event::where('zone_id', $sector['zone_id'])->where('type', 'zona')->whereDate('start_date', '>=', Carbon::now())->get();
                $zone = Zone::find($sector['zone_id'])->first();
                $d_events = Event::where('zone_id', '')->where('type', 'distrito')->where('district_id', $zone['district_id'])->whereDate('start_date', '>=', Carbon::now())->get();
                break;
            case 'Pastor de Zona':
                $zone = Zone::where('user_id', $user_id)->first();
                $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                $z_events = Event::where('zone_id', $zone->id)->where('type', 'zona')->whereDate('start_date', '>=', Carbon::now())->get();
                $d_events = Event::where('district_id', $zone->district_id)->where('type', 'distrito')->whereDate('start_date', '>=', Carbon::now())->get();
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
                    ->whereBetween('date',[ $startWeek,$endWeek ])->first();
            $total_attendance = $data['total_attendance'] ?? 0;
            $church_offering = $data['church_offering'] ?? 0;
            $total_adult_attendance = $data['total_adult_attendance'] ?? 0;
            $total_youth_attendance = $data['total_youth_attendance'] ?? 0;
            $total_children_attendance = $data['total_children_attendance'] ?? 0;

            $goals = Goal::where('start_period', '<=', now())->where('end_period', '>=', now())->first();
            $goals_control = GoalControl::where('cell_id', $cell->id)->first();
            $goals_control['assistance_adv'] = ((int)$goals_control->assistance / (int)$goals['assistance']) * 100;
            $members = Member::whereHas('cell', function ($query) use ($cell) {
                $query->where('cell_id', $cell->id);
            })->where('status', 1)->get();

        } else {
            $data = Report::whereIn('cell_id', $cells)
                    ->whereBetween('date',[ $startWeek,$endWeek ])->get();
            $total_attendance = $data->sum('total_attendance') ?? 0;
            $church_offering = $data->sum('church_offering') ?? 0;
            $total_adult_attendance = $data->sum('total_adult_attendance') ?? 0;
            $total_youth_attendance = $data->sum('total_youth_attendance') ?? 0;
            $total_children_attendance = $data->sum('total_children_attendance') ?? 0;

            $goals = Goal::where('start_period', '<=', now())->where('end_period', '>=', now())->first();
            $goals_cntrl = GoalControl::whereIn('cell_id', $cells)->get();
            $assistance_sum = 0;
            $assistance_tt = 0;
            foreach ($goals_cntrl as $goal_control){
                $assistance_sum += (int)$goal_control->assistance / (int)$goals['assistance'];
                $assistance_tt ++;
            }

            $goals_control['assistance_adv'] = ($assistance_sum / $assistance_tt) * 100;

            $members = Member::whereHas('cell', function ($query) use ($cells) {
                $query->whereIn('cell_id', $cells);
            })->where('status', 1)->get();
        }

        $_events = $g_events->merge($d_events)->merge($z_events);
        $events = $_events->sortBy('start_date');

        return compact('total_attendance', 'church_offering', 'total_adult_attendance', 'total_youth_attendance', 'total_children_attendance', 'goals_control', 'members', 'events');
    }
}
