<?php

namespace App\Http\Controllers;

use App\Models\GoalControl;
use App\Http\Requests\StoreGoalControlRequest;
use App\Http\Requests\UpdateGoalControlRequest;

class GoalControlController extends Controller
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
     * @param  \App\Http\Requests\StoreGoalControlRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoalControlRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoalControl  $goalControl
     * @return \Illuminate\Http\Response
     */
    public function show(GoalControl $goalControl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GoalControl  $goalControl
     * @return \Illuminate\Http\Response
     */
    public function edit(GoalControl $goalControl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGoalControlRequest  $request
     * @param  \App\Models\GoalControl  $goalControl
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGoalControlRequest $request, GoalControl $goalControl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoalControl  $goalControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoalControl $goalControl)
    {
        //
    }
}
