<?php

namespace App\Http\Controllers;

use App\Models\CellInitialData;
use App\Http\Requests\StoreCellInitialDataRequest;
use App\Http\Requests\UpdateCellInitialDataRequest;

class CellInitialDataController extends Controller
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
     * @param  \App\Http\Requests\StoreCellInitialDataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCellInitialDataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CellInitialData  $cellInitialData
     * @return \Illuminate\Http\Response
     */
    public function show(CellInitialData $cellInitialData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CellInitialData  $cellInitialData
     * @return \Illuminate\Http\Response
     */
    public function edit(CellInitialData $cellInitialData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCellInitialDataRequest  $request
     * @param  \App\Models\CellInitialData  $cellInitialData
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCellInitialDataRequest $request, CellInitialData $cellInitialData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CellInitialData  $cellInitialData
     * @return \Illuminate\Http\Response
     */
    public function destroy(CellInitialData $cellInitialData)
    {
        //
    }
}
