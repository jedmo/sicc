<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCellMemberRequest;
use App\Http\Requests\UpdateCellMemberRequest;
use App\Http\Resources\CellMembersCollection;
use App\Models\Cell;
use App\Models\CellMember;
use App\Models\Address;
use App\Models\MunicipalDistrict;
use App\Traits\DataFilterTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CellMemberController extends Controller
{
    use DataFilterTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index($cell_id = null)
    {
        if (!$cell_id){
            $members = $this->getCellMembersData();
        } else {
            $members = CellMember::where('cell_id', $cell_id)->orderBy('id','desc')->paginate(10);
        }

        return view('modules.cell_members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];
        if ($role == 'Líder') {
            $cells = Cell::where('user_leader_id', $user_id)->first();
        } else {
            $cells = Cell::all();
        }

        $address = new Address(['municipal_district_id' => 192]);
        $cellMember = new CellMember;
        $cellMember->address()->associate($address);
        $municipalities = MunicipalDistrict::all();

        return view('modules.cell_members.create', compact('cells', 'cellMember', 'municipalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCellMemberRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCellMemberRequest $request)
    {
        $request->validated();
        $address_input = $request->safe()->only(['address', 'house_num', 'street', 'canton', 'hamlet', 'municipal_district_id']);
        $member_input = $request->safe()->except(['address', 'house_num', 'street', 'canton', 'hamlet', 'municipal_district_id']);

        $address = Address::create($address_input);

        $b_date = $member_input['birth_date'];
        $c_date = $member_input['conversion_date'];
        $formatted_b_d = Carbon::createFromFormat('d/m/Y', $b_date)->format('Y-m-d');
        $formatted_c_d = Carbon::createFromFormat('d/m/Y', $c_date)->format('Y-m-d');
        $member_input['birth_date'] = $formatted_b_d;
        $member_input['conversion_date'] = $formatted_c_d;
        $member_input['address_id'] = $address->id;

        CellMember::create($member_input);

        return redirect()->route('cell-members.index')->with('success','Nuevo miembro agregado.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CellMember  $cellMember
     * @return \Illuminate\View\View
     */
    public function edit(CellMember $cellMember)
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];
        if ($role == 'Líder') {
            $cells = Cell::where('user_leader_id', $user_id)->first();
        } else {
            $cells = Cell::all();
        }
        $municipalities = MunicipalDistrict::all();

        return view('modules.cell_members.edit',compact('cellMember', 'cells', 'municipalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCellMemberRequest  $request
     * @param  \App\Models\CellMember  $cellMember
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCellMemberRequest $request, CellMember $cellMember)
    {
        $request->validated();
        $address_input = $request->safe()->only(['address', 'house_num', 'street', 'canton', 'hamlet', 'municipal_district_id']);
        $member_input = $request->safe()->except(['address', 'house_num', 'street', 'canton', 'hamlet', 'municipal_district_id']);

        $b_date = $member_input['birth_date'];
        $c_date = $member_input['conversion_date'];

        if($b_date) {
            $b_date = Carbon::createFromFormat('d/m/Y', $b_date)->format('Y-m-d');
            $member_input['birth_date'] = $b_date;
        }

        if($c_date) {
            $c_date = Carbon::createFromFormat('d/m/Y', $c_date)->format('Y-m-d');
            $member_input['conversion_date'] = $c_date;
        }

        $address_id = $cellMember['address_id'];
        $address = Address::find($address_id);

        $address->fill($address_input)->save();
        $cellMember->fill($member_input)->save();

        return redirect()->route('cell-members.index')->with('success','Datos del miembro actualizados con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CellMember  $cellMember
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CellMember $cellMember)
    {
        $cellMember->delete();
        return redirect()->route('cell-members.index')->with('success','Miembro removido exitosamente.');
    }

    public function list($cell_id)
    {
        return new CellMembersCollection(CellMember::where('cell_id', $cell_id)->whereHas('member', function ($query) {$query->where('status', 1);})->get());
    }
}
