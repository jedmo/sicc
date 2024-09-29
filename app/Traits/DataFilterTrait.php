<?php
namespace App\Traits;

use App\Models\Cell;
use App\Models\CellMember;
use App\Models\ChurchAttendance;
use App\Models\District;
use App\Models\Report;
use App\Models\Sector;
use App\Models\Zone;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

trait DataFilterTrait
{
    public function getCellData()
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        switch ($role) {
            case 'Líder':
                $cells = Cell::where('user_leader_id', $user_id)->with(['leader','host'])->paginate(10);
                break;
            case 'Supervisor':
                $sector = Sector::where('user_id', $user_id)->first();
                $cells = Cell::where('sector_id', $sector->id)->with(['leader','host'])->orderBy('code','asc')->paginate(10);
                break;
            case 'Pastor de Zona':
                $zone = Zone::where('user_id', $user_id)->first();
                $sector = Sector::where('zone_id', $zone->id)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->orderBy('code','asc')->paginate(10);
                break;
            case 'Pastor de Distrito':
                $district = District::where('user_id', $user_id)->first();
                $zone = Zone::where('district_id', $district->id)->pluck('id');
                $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->orderBy('code','asc')->paginate(10);
                break;
            case 'Pastor General':
            case 'Anciano':
                $cells = Cell::orderBy('code','asc')->paginate(10);
                break;
            default:
                $cells = Cell::orderBy('code','asc')->paginate(10);
        }

        return $cells;
    }

    public function getSector()
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        switch ($role) {
            case 'Líder':
                $sectors = null;
                break;
            case 'Supervisor':
                $sectors = Sector::where('user_id', $user_id)->first();
                break;
            case 'Pastor de Zona':
                $zone = Zone::where('user_id', $user_id)->first();
                $sectors = Sector::where('zone_id', $zone->id)->with('member')->paginate(10);
                break;
            case 'Pastor de Distrito':
                $district = District::where('user_id', $user_id)->first();
                $zone = Zone::where('district_id', $district->id)->pluck('id');
                $sectors = Sector::whereIn('zone_id', $zone)->paginate(10);
                break;
            case 'Pastor General':
            case 'Anciano':
                $sectors = Sector::orderBy('id','desc')->paginate(10);
                break;
            default:
                $sectors = Sector::orderBy('id','desc')->paginate(10);
        }

        return $sectors;
    }

    public function getZone()
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        switch ($role) {
            case 'Líder':
                $zones = null;
                break;
            case 'Supervisor':
                $zones = null;
                break;
            case 'Pastor de Zona':
                $zones = Zone::where('user_id', $user_id)->first();
                break;
            case 'Pastor de Distrito':
                $district = District::where('user_id', $user_id)->first();
                $zones = Zone::where('district_id', $district->id)->paginate(10);
                break;
            case 'Pastor General':
            case 'Anciano':
                $zones = Zone::orderBy('id','desc')->paginate(10);
                break;
            default:
                $zones = Zone::orderBy('id','desc')->paginate(10);
        }

        return $zones;
    }

    public function getDistrict()
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        switch ($role) {
            case 'Líder':
                $district = null;
                break;
            case 'Supervisor':
                $district = null;
                break;
            case 'Pastor de Zona':
                $district = null;
                break;
            case 'Pastor de Distrito':
                $district = District::where('user_id', $user_id)->first();
                break;
            case 'Pastor General':
            case 'Anciano':
                $district = District::orderBy('id','desc')->paginate(10);
                break;
            default:
                $district = District::orderBy('id','desc')->paginate(10);
        }

        return $district;
    }

    public function getReportData($cell_id = null)
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        if(!$cell_id){
            switch ($role) {
                case 'Líder':
                    $cell = Cell::where('user_leader_id', $user_id)->first();
                    $reports = Report::where('cell_id', $cell->id)->orderBy('date','desc')->paginate(10);
                    break;
                case 'Supervisor':
                    $sector = Sector::where('user_id', $user_id)->first();
                    $cells = Cell::where('sector_id', $sector->id)->pluck('id');
                    $reports = Report::whereIn('cell_id', $cells)->orderBy('date','desc')->paginate(10);
                    break;
                case 'Pastor de Zona':
                    $zone = Zone::where('user_id', $user_id)->first();
                    $sector = Sector::where('zone_id', $zone->id)->pluck('id');
                    $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                    $reports = Report::whereIn('cell_id', $cells)->orderBy('id','desc')->paginate(10);
                    break;
                case 'Pastor de Distrito':
                    $district = District::where('user_id', $user_id)->first();
                    $zone = Zone::where('district_id', $district->id)->pluck('id');
                    $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                    $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                    $reports = Report::whereIn('cell_id', $cells)->orderBy('id','desc')->paginate(10);
                    break;
                case 'Pastor General':
                case 'Anciano':
                    $reports = Report::orderBy('id','desc')->paginate(10);
                    break;
                default:
                    $reports = Report::orderBy('id','desc')->paginate(10);
            }
        } else {
            $reports = Report::where('cell_id', $cell_id)->orderBy('id','desc')->paginate(10);
        }

        return $reports;
    }

    public function getCells($cell_id = null)
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        if(!$cell_id){
            switch ($role) {
                case 'Líder':
                    $cells = Cell::where('user_leader_id', $user_id)->first();
                    break;
                case 'Supervisor':
                    $sector = Sector::where('user_id', $user_id)->first();
                    $cells = Cell::where('sector_id', $sector->id)->orderBy('full_code','asc')->get();
                    break;
                case 'Pastor de Zona':
                    $zone = Zone::where('user_id', $user_id)->first();
                    $sector = Sector::where('zone_id', $zone->id)->pluck('id');
                    $cells = Cell::whereIn('sector_id', $sector)->orderBy('full_code','asc')->get();
                    break;
                case 'Pastor de Distrito':
                    $district = District::where('user_id', $user_id)->first();
                    $zone = Zone::where('district_id', $district->id)->pluck('id');
                    $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                    $cells = Cell::whereIn('sector_id', $sector)->orderBy('full_code','asc')->get();
                    break;
                case 'Pastor General':
                case 'Anciano':
                    $cells = Cell::orderBy('id','desc')->orderBy('full_code','asc')->get();
                    break;
                default:
                    $cells = Cell::orderBy('id','desc')->orderBy('full_code','asc')->get();
            }
        } else {
            $cells = Cell::where('cell_id', $cell_id)->orderBy('id','desc')->orderBy('full_code','asc')->get();
        }

        return $cells;
    }

    public function getSectors()
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        switch ($role) {
            case 'Líder':
                $sectors = null;
                break;
            case 'Supervisor':
                $sectors = Sector::where('user_id', $user_id)->first();
                break;
            case 'Pastor de Zona':
                $zone = Zone::where('user_id', $user_id)->first();
                $sectors = Sector::where('zone_id', $zone->id)->with('member')->get();
                break;
            case 'Pastor de Distrito':
                $district = District::where('user_id', $user_id)->first();
                $zone = Zone::where('district_id', $district->id)->pluck('id');
                $sectors = Sector::whereIn('zone_id', $zone)->get();
                break;
            case 'Pastor General':
            case 'Anciano':
                $sectors = Sector::orderBy('id','desc')->get();
                break;
            default:
                $sectors = Sector::orderBy('id','desc')->get();
        }

        return $sectors;
    }

    public function getZones()
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        switch ($role) {
            case 'Líder':
                $zones = null;
                break;
            case 'Supervisor':
                $zones = null;
                break;
            case 'Pastor de Zona':
                $zones = Zone::where('user_id', $user_id)->first();
                break;
            case 'Pastor de Distrito':
                $district = District::where('user_id', $user_id)->first();
                $zones = Zone::where('district_id', $district->id)->get();
                break;
            case 'Pastor General':
            case 'Anciano':
                $zones = Zone::orderBy('id','desc')->get();
                break;
            default:
                $zones = Zone::orderBy('id','desc')->get();
        }

        return $zones;
    }


    public function getAttendanceData($week)
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];
        $dates = explode(' - ', $week);
        $start_date = Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d');
        $end_date = Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d');

        switch ($role) {
            case 'Líder':
                $cell = Cell::where('user_leader_id', $user_id)->first();
                $church_attendances = ChurchAttendance::where('cell_id', $cell->id)->orderBy('start_date','desc')->paginate(10);
                break;
            case 'Supervisor':
                $sector = Sector::where('user_id', $user_id)->first();
                $cells = Cell::where('sector_id', $sector->id)->pluck('id');
                $church_attendances = ChurchAttendance::whereIn('cell_id', $cells)->orderBy('start_date','desc')->paginate(10);
                break;
            case 'Pastor de Zona':
                $zone = Zone::where('user_id', $user_id)->first();
                $sector = Sector::where('zone_id', $zone->id)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                $church_attendances = ChurchAttendance::whereIn('cell_id', $cells)->orderBy('start_date','desc')->paginate(10);
                break;
            case 'Pastor de Distrito':
                $district = District::where('user_id', $user_id)->first();
                $zone = Zone::where('district_id', $district->id)->pluck('id');
                $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                $church_attendances = ChurchAttendance::whereIn('cell_id', $cells)->orderBy('start_date','desc')->paginate(10);
                break;
            case 'Pastor General':
            case 'Anciano':
                $church_attendances = ChurchAttendance::orderBy('start_date','desc')->paginate(10);
                break;
            default:
                $church_attendances = ChurchAttendance::orderBy('start_date','desc')->paginate(10);
        }

        return $church_attendances;
    }

    public function getMembersData()
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        switch ($role) {
            case 'Líder':
                $cell = Cell::where('user_leader_id', $user_id)->first();
                $members = CellMember::where('cell_id', $cell->id)
                        ->join('members', 'cell_members.member_id', '=', 'members.id')
                        ->orderBy('members.status', 'desc')
                        ->paginate(10);
                break;
            case 'Supervisor':
                $sector = Sector::where('user_id', $user_id)->first();
                $cells = Cell::where('sector_id', $sector->id)->pluck('id');
                $members = CellMember::whereIn('cell_id', $cells)->orderBy('id','desc')->paginate(10);
                break;
            case 'Pastor de Zona':
                $zone = Zone::where('user_id', $user_id)->first();
                $sector = Sector::where('zone_id', $zone->id)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                $members = CellMember::whereIn('cell_id', $cells)->orderBy('id','desc')->paginate(10);
                break;
            case 'Pastor de Distrito':
                $district = District::where('user_id', $user_id)->first();
                $zone = Zone::where('district_id', $district->id)->pluck('id');
                $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                $members = CellMember::whereIn('cell_id', $cells)->orderBy('id','desc')->paginate(10);
                break;
            case 'Pastor General':
            case 'Anciano':
                $members = CellMember::orderBy('id','desc')->paginate(10);
                break;
            default:
                $members = CellMember::orderBy('id','desc')->paginate(10);
        }

        return $members;
    }

    public function getMembers()
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        switch ($role) {
            case 'Líder':
                $cell = Cell::where('user_leader_id', $user_id)->first();
                $members = CellMember::where('cell_id', $cell->id)->orderBy('id','desc')->get();
                break;
            case 'Supervisor':
                $sector = Sector::where('user_id', $user_id)->first();
                $cells = Cell::where('sector_id', $sector->id)->pluck('id');
                $members = CellMember::whereIn('cell_id', $cells)->orderBy('id','desc')->get();
                break;
            case 'Pastor de Zona':
                $zone = Zone::where('user_id', $user_id)->first();
                $sector = Sector::where('zone_id', $zone->id)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                $members = CellMember::whereIn('cell_id', $cells)->orderBy('id','desc')->get();
                break;
            case 'Pastor de Distrito':
                $district = District::where('user_id', $user_id)->first();
                $zone = Zone::where('district_id', $district->id)->pluck('id');
                $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
                $members = CellMember::whereIn('cell_id', $cells)->orderBy('id','desc')->get();
                break;
            case 'Pastor General':
            case 'Anciano':
                $members = CellMember::orderBy('id','desc')->get();
                break;
            default:
                $members = CellMember::orderBy('id','desc')->get();
        }

        return $members;
    }

    // public function getCellMembersData()
    // {
    //     $user_id = Auth::id();
    //     $role = Auth::user()->roles->pluck('name')[0];

    //     switch ($role) {
    //         case 'Líder':
    //             $cell = Cell::where('user_leader_id', $user_id)->first();
    //             $members = CellMember::where('cell_id', $cell->id)->orderBy('id','desc')->paginate(10);
    //             break;
    //         case 'Supervisor':
    //             $sector = Sector::where('user_id', $user_id)->first();
    //             $cells = Cell::where('sector_id', $sector->id)->pluck('id');
    //             $members = CellMember::whereIn('cell_id', $cells)->orderBy('id','desc')->paginate(10);
    //             break;
    //         case 'Pastor de Zona':
    //             $zone = Zone::where('user_id', $user_id)->first();
    //             $sector = Sector::where('zone_id', $zone->id)->pluck('id');
    //             $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
    //             $members = CellMember::whereIn('cell_id', $cells)->orderBy('id','desc')->paginate(10);
    //             break;
    //         case 'Pastor de Distrito':
    //             $district = District::where('user_id', $user_id)->first();
    //             $zone = Zone::where('district_id', $district->id)->pluck('id');
    //             $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
    //             $cells = Cell::whereIn('sector_id', $sector)->pluck('id');
    //             $members = CellMember::whereIn('cell_id', $cells)->orderBy('id','desc')->paginate(10);
    //             break;
    //         case 'Pastor General':
    //         case 'Anciano':
    //             $members = CellMember::orderBy('id','desc')->paginate(10);
    //             break;
    //         default:
    //             $members = CellMember::orderBy('id','desc')->paginate(10);
    //     }

    //     return $members;
    // }

    public function getLastWeekCellData($user_id, $role)
    {
        $startWeek = Carbon::now()->subWeek('4')->startOfWeek();
        $endWeek   = Carbon::now()->subWeek()->endOfWeek();

        switch ($role) {
            case 'Líder':
                $cell = Cell::where('user_leader_id', $user_id)->first();
                break;
            case 'Supervisor':
                $sector = Sector::where('user_id', $user_id)->first();
                $cells = Cell::where('sector_id', $sector->id)->get();
                break;
            case 'Pastor de Zona':
                $zone = Zone::where('user_id', $user_id)->first();
                $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->get();
                break;
            case 'Pastor de Distrito':
                $district = District::where('user_id', $user_id)->first();
                $zone = Zone::where('district_id', $district->id)->pluck('id');
                $sector = Sector::whereIn('zone_id', $zone)->pluck('id');
                $cells = Cell::whereIn('sector_id', $sector)->get();
                break;
            case 'Pastor General':
            case 'Anciano':
                $cells = Cell::all();
                break;
            default:
                $cells = Cell::all();
        }
        if (!empty($cell)) {
            $data = Report::where('cell_id', $cell->id)
                    ->whereBetween('date',[ $startWeek,$endWeek ])->first();
            $total_attendance = $data['total_attendance'] ?? 0;
            $church_offering = $data['church_offering'] ?? 0;
            $total_adult_attendance = $data['total_adult_attendance'] ?? 0;
            $total_youth_attendance = $data['total_youth_attendance'] ?? 0;
            $total_children_attendance = $data['total_children_attendance'] ?? 0;
        } else {
            $data = Report::whereIn('cell_id', $cells->pluck('id'))
                    ->whereBetween('date',[ $startWeek,$endWeek ])->get();
            $total_attendance = $data->sum('total_attendance') ?? 0;
            $church_offering = $data->sum('church_offering') ?? 0;
            $total_adult_attendance = $data->sum('total_adult_attendance') ?? 0;
            $total_youth_attendance = $data->sum('total_youth_attendance') ?? 0;
            $total_children_attendance = $data->sum('total_children_attendance') ?? 0;
        }

        return compact('total_attendance', 'church_offering', 'total_adult_attendance', 'total_youth_attendance', 'total_children_attendance');
    }
}
