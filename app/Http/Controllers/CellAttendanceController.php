<?php

namespace App\Http\Controllers;

use App\Models\CellAttendance;
use App\Http\Requests\StoreCellAttendanceRequest;
use App\Http\Requests\UpdateCellAttendanceRequest;

class CellAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCellAttendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCellAttendanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CellAttendance  $cellAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(CellAttendance $cellAttendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CellAttendance  $cellAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(CellAttendance $cellAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCellAttendanceRequest  $request
     * @param  \App\Models\CellAttendance  $cellAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCellAttendanceRequest $request, CellAttendance $cellAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CellAttendance  $cellAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(CellAttendance $cellAttendance)
    {
        //
    }
}
