<?php

namespace App\Http\Controllers;

use App\Models\SectorInitialData;
use App\Http\Requests\StoreSectorInitialDataRequest;
use App\Http\Requests\UpdateSectorInitialDataRequest;

class SectorInitialDataController extends Controller
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
     * @param  \App\Http\Requests\StoreSectorInitialDataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectorInitialDataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SectorInitialData  $sectorInitialData
     * @return \Illuminate\Http\Response
     */
    public function show(SectorInitialData $sectorInitialData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SectorInitialData  $sectorInitialData
     * @return \Illuminate\Http\Response
     */
    public function edit(SectorInitialData $sectorInitialData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSectorInitialDataRequest  $request
     * @param  \App\Models\SectorInitialData  $sectorInitialData
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectorInitialDataRequest $request, SectorInitialData $sectorInitialData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SectorInitialData  $sectorInitialData
     * @return \Illuminate\Http\Response
     */
    public function destroy(SectorInitialData $sectorInitialData)
    {
        //
    }
}
