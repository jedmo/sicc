<?php

namespace App\Http\Controllers;

use App\Models\Multiplication;
use App\Http\Requests\StoreMultiplicationRequest;
use App\Http\Requests\UpdateMultiplicationRequest;

class MultiplicationController extends Controller
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
     * @param  \App\Http\Requests\StoreMultiplicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMultiplicationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Multiplication  $multiplication
     * @return \Illuminate\Http\Response
     */
    public function show(Multiplication $multiplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Multiplication  $multiplication
     * @return \Illuminate\Http\Response
     */
    public function edit(Multiplication $multiplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMultiplicationRequest  $request
     * @param  \App\Models\Multiplication  $multiplication
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMultiplicationRequest $request, Multiplication $multiplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Multiplication  $multiplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Multiplication $multiplication)
    {
        //
    }
}
