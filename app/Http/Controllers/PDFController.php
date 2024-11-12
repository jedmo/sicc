<?php

namespace App\Http\Controllers;

use App\Models\Cell;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{
    public function generatePDF($sector_id)
    {
        $cells = Cell::where('sector_id', $sector_id)->pluck('id');
        $reports = Report::select('reports.*', 'church_attendances.total_attendance_1d', 'church_attendances.total_attendance_2d', 'church_attendances.total_attendance_sd')
        ->leftJoin('church_attendances', function($join) {
            $join->on('reports.cell_id', '=', 'church_attendances.cell_id')
                ->where('reports.date', '>=', DB::raw('church_attendances.start_date'))
                ->where('reports.date', '<=', DB::raw('church_attendances.end_date'));
        })
        ->whereIn('reports.cell_id', $cells)
        ->orderBy('reports.date', 'desc')
        ->take(10)->get();

        $pdf = PDF::loadView('modules.reports.pdf', compact('reports'))->setPaper('legal', 'landscape');

        return $pdf->stream();

    }
}
