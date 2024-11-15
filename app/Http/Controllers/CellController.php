<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCellRequest;
use App\Http\Requests\UpdateCellRequest;
use App\Models\Address;
use App\Models\Cell;
use App\Models\CellInitialData;
use App\Models\CellMember;
use App\Models\Goal;
use App\Models\GoalControl;
use App\Models\MunicipalDistrict;
use App\Models\User;
use App\Traits\DataFilterTrait;
use Illuminate\Support\Carbon;

class CellController extends Controller
{
    use DataFilterTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index($sector_id = null)
    {
        if (!$sector_id){
            $cells = $this->getCellData();
        } else {
            $cells = Cell::where('sector_id', $sector_id)->with(['leader','host'])->orderBy('code','desc')->paginate(10);
        }
        // dd($cells);
        return view('modules.cells.index', compact('cells'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $show = 0;
        $cell = new Cell;
        $initial = new CellInitialData();
        $members = $this->getMembers();
        $sectors = $this->getSector();
        $municipalities = MunicipalDistrict::all();
        $address = new Address(['municipal_district_id' => 192]);
        $cell->address()->associate($address);
        $cell->sector()->associate($sectors);

        return view('modules.cells.create', compact('members', 'cell', 'sectors', 'address', 'municipalities', 'show', 'initial'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCellRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCellRequest $request)
    {
        $request->validated();
        $address_input = $request->safe()->only(['address', 'house_num', 'street', 'canton', 'hamlet', 'municipal_district_id']);
        $initial_input = $request->safe()->only(['child_attendance', 'young_attendance', 'adult_attendance']);
        $cell_input = $request->safe()->except(['address', 'house_num', 'street', 'canton', 'hamlet', 'municipal_district_id', 'sector_code','child_attendance', 'young_attendance', 'adult_attendance']);

        $address = Address::create($address_input);
        $cell_input['address_id'] = $address->id;

        $code = $request->input('code');
        $cell_input['full_code'] = $request->input('sector_code') . ' C:' . $code;
        $cell = Cell::create($cell_input);

        $goal = Goal::latest()->first();
        $initial_input['cell_id'] = $cell->id;
        $initial_input['goal_id'] = $goal->id;
        $initial_input['initial_date'] = Carbon::now()->toDateString();
        CellInitialData::create($initial_input);

        return redirect()->route('cells.index')->with('success','La célula ha sido creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\View\View
     */
    public function show(Cell $cell)
    {
        $members = CellMember::where('cell_id', $cell->id)->with('member')
            ->join('members', 'cell_members.member_id', '=', 'members.id') // Join with the members table
            ->select('cell_members.*')
            ->orderBy('members.status', 'desc')->get();
        $municipalities = MunicipalDistrict::all();
        $show = 1;
        $goals = Goal::where('start_period', '<=', now())->where('end_period', '>=', now())->first();
        $years = $goals->years;
        $actual = Carbon::now()->diffInYears($goals->start_period);
        $goals['leader'] = (int)$goals->leader / $years;
        $goals['conversions'] = ((int)$goals->conversions / $years) * (int)$actual;
        $goals['baptisms'] = ((int)$goals->baptisms / $years) * (int)$actual;
        $goals['programmed_visits'] = ((int)$goals->programmed_visits / $years) * (int)$actual;

        $goals_control = GoalControl::where('cell_id', $cell->id)->first();
        if ($goals_control) {
            $goals_control['assistance_adv'] = ((int)$goals_control->assistance / (int)$goals['assistance']) * 100;
            $goals_control['conversions_adv'] = ((int)$goals_control->conversions / (int)$goals['conversions']) * 100;
            $goals_control['baptisms_adv'] = ((int)$goals_control->baptisms / (int)$goals['baptisms']) * 100;
            $goals_control['programmed_visits_adv'] = ((int)$goals_control->programmed_visits / (int)$goals['programmed_visits']) * 100;
        } else {
            $goals_control['assistance_adv'] = 0;
            $goals_control['conversions_adv'] = 0;
            $goals_control['baptisms_adv'] = 0;
            $goals_control['programmed_visits_adv'] = 0;
        }

        $initial = CellInitialData::where('cell_id', $cell->id)->first();

        return view('modules.cells.show',compact('cell', 'members', 'municipalities', 'show', 'goals', 'goals_control', 'initial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\View\View
     */
    public function edit(Cell $cell)
    {
        // $members = CellMember::where('cell_id', $cell->id)->with('member')->get();
        $members = $this->getMembers();
        $initial = CellInitialData::where('cell_id', $cell->id)->firstOrNew();
        $show = 0;
        $municipalities = MunicipalDistrict::all();
        return view('modules.cells.edit',compact('cell', 'members', 'municipalities', 'initial', 'show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCellRequest  $request
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCellRequest $request, Cell $cell)
    {
        $request->validated();
        $address_input = $request->safe()->only(['address', 'house_num', 'street', 'canton', 'hamlet', 'municipal_district_id']);
        $initial_input = $request->safe()->only(['child_attendance', 'young_attendance', 'adult_attendance']);
        $cell_input = $request->safe()->except(['address', 'house_num', 'street', 'canton', 'hamlet', 'municipal_district_id', 'sector_code', 'child_attendance', 'young_attendance', 'adult_attendance']);

        $address_id = $cell['address_id'];
        $address = Address::find($address_id);
        $address->fill($address_input)->save();

        $code = $request->input('code');
        $cell_input['full_code'] = $request->input('sector_code') . ' C:' . $code;
        $cell->fill($cell_input)->save();
        $initial = CellInitialData::find($cell->id);
        if ($initial) {
            $initial->fill($initial_input)->save();
        } else {
            $goal = Goal::latest()->first();
            $initial_input['cell_id'] = $cell->id;
            $initial_input['goal_id'] = $goal->id;
            $initial_input['initial_date'] = Carbon::now()->toDateString();
            CellInitialData::create($initial_input);
        }

        return redirect()->route('cells.index')->with('success','La célula ha sido actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Cell $cell)
    {
        $cell->delete();
        return redirect()->route('cells.index')->with('success','La célula ha sido eliminada exitosamente');
    }
}
