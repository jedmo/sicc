<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Address;
use App\Models\Cell;
use App\Models\CellMember;
use App\Models\Member;
use App\Models\MunicipalDistrict;
use App\Models\Sector;
use App\Traits\DataFilterTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    use DataFilterTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cell_id = request('cell_id');
        if (!$cell_id){
            $members = $this->getMembersData();
        } else {
            $members = CellMember::where('cell_id', $cell_id)
            ->join('members', 'cell_members.member_id', '=', 'members.id')
            ->orderBy('members.status', 'desc')
            ->paginate(10);
        }

        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];

        if ($role == 'Supervisor') {
            $sector = Sector::where('user_id', $user_id)->first();
            $cells = Cell::where('sector_id', $sector->id)->orderBy('id','desc')->get();
        } else {
            $cells = $this->getCellData();
        }

        return view('modules.members.index', compact('members', 'cells', 'cell_id'));
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
        } elseif($role == 'Supervisor') {
            $sector = Sector::where('user_id', $user_id)->first();
            $cells = Cell::where('sector_id', $sector->id)->orderBy('id','desc')->get();
        } else {
            $cells = Cell::all();
        }

        $address = new Address(['municipal_district_id' => 192]);
        $member = new Member;
        $member->address()->associate($address);

        $cell_member = new CellMember;
        $cell_member->member_id = $member->id;
        $cell_member->cell_id = null;
        $cell_member->save();

        $municipalities = MunicipalDistrict::all();

        return view('modules.members.create', compact('cells', 'member', 'municipalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMemberRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMemberRequest $request)
    {
        $request->validated();
        $address_input = $request->safe()->only(['address', 'house_num', 'street', 'canton', 'hamlet', 'municipal_district_id']);
        $member_input = $request->safe()->except(['address', 'house_num', 'street', 'canton', 'hamlet', 'municipal_district_id', 'cell_id']);
        $cell_member_input = $request->safe()->only(['cell_id']);

        $address = Address::create($address_input);
        $member_input['address_id'] = $address->id;

        $b_date = $member_input['birth_date'];
        $c_date = $member_input['conversion_date'];
        $member_input['birth_date'] = !empty($b_date) ? Carbon::createFromFormat('d/m/Y', $b_date)->format('Y-m-d') : null;
        $member_input['conversion_date'] = !empty($c_date) ? Carbon::createFromFormat('d/m/Y', $c_date)->format('Y-m-d') : null;

        $member = Member::create($member_input);
        $cell_member_input['member_id'] = $member->id;

        CellMember::create($cell_member_input);

        return redirect()->route('members.index')->with('success','Nuevo miembro agregado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\View\View
     */
    public function show(Member $member)
    {
        return view('modules.members.show',compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\View\View
     */
    public function edit(Member $member)
    {
        $user_id = Auth::id();
        $role = Auth::user()->roles->pluck('name')[0];
        if ($role == 'Líder') {
            $cells = Cell::where('user_leader_id', $user_id)->first();
        } elseif($role == 'Supervisor') {
            $sector = Sector::where('user_id', $user_id)->first();
            $cells = Cell::where('sector_id', $sector->id)->orderBy('id','desc')->get();
        } else {
            $cells = Cell::all();
        }
        $municipalities = MunicipalDistrict::all();

        return view('modules.members.edit',compact('member', 'cells', 'municipalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMemberRequest  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $request->validated();
        $address_input = $request->safe()->only(['address', 'house_num', 'street', 'canton', 'hamlet', 'municipal_district_id']);
        $member_input = $request->safe()->except(['address', 'house_num', 'street', 'canton', 'hamlet', 'municipal_district_id', 'cell_id']);

        $b_date = $member_input['birth_date'];
        $c_date = $member_input['conversion_date'];
        $member_input['birth_date'] = !empty($b_date) ? Carbon::createFromFormat('d/m/Y', $b_date)->format('Y-m-d') : null;
        $member_input['conversion_date'] = !empty($c_date) ? Carbon::createFromFormat('d/m/Y', $c_date)->format('Y-m-d') : null;

        $address_id = $member['address_id'];
        $address = Address::find($address_id);

        $address->fill($address_input)->save();
        $member->fill($member_input)->save();

        return redirect()->route('members.index')->with('success','Datos del miembro actualizados con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Member $member)
    {
        $member_id = $member['id'];
        $cell_member = CellMember::where('member_id', $member_id);
        $address_id = $member['address_id'];
        $address = Address::find($address_id);
        try{
            $cell_member->delete();
        } catch (\Exception $e){
            return redirect()->route('members.index')->with('error','Este miembro no se puede remover porque esta asignado a una célula.');
        }
        $member->delete();
        $address->delete();
        return redirect()->route('members.index')->with('success','Miembro removido exitosamente.');
    }
}
