<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupportRequest;
use App\Http\Requests\UpdateSupportRequest;
use App\Models\Support;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];
        if ($role == 'Líder' || $role == 'Supervisor') {
            $supports = Support::where('user_id', $user_id)->get();
        } else {
            $supports = Support::all()->paginate(10);
        }

        return view('modules.supports.index', compact('supports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $support = new Support;

        return view('modules.supports.create', compact('support'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSupportRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSupportRequest $request)
    {
        $validated_data = $request->validated();
        $validated_data['user_id'] = Auth::id();
        $validated_data['status'] = 1;
        Support::create($validated_data);

        return redirect()->route('supports.index')->with('success','La célula ha sido creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function show(Support $support)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function edit(Support $support)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupportRequest  $request
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupportRequest $request, Support $support)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function destroy(Support $support)
    {
        //
    }
}
