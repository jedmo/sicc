
<div class="userDatatable global-shadow border-light-0 w-100">
    <div class="table-responsive">
        <table class="table mb-0 table-borderless" id="cell-member-attendance-table">
            <thead>
                <tr class="userDatatable-header">
                    <th class="pe-0">
                        <div class="d-flex align-items-center">
                            <div class="custom-checkbox check-all">
                                <input class="checkbox" type="checkbox" id="check-all">
                                <label for="check-all" class="ps-0">
                                    <span class="checkbox-text userDatatable-title"></span>
                                </label>
                            </div>
                        </div>
                    </th>
                    <th>
                        <span class="userDatatable-title">Nombre</span>
                    </th>
                    <th>
                        <span class="userDatatable-title">Edad</span>
                    </th>
                    {{-- <th>
                        <span class="userDatatable-title">Fecha de nacimiento</span>
                    </th> --}}
                </tr>
            </thead>
            <tbody>
                @if (count($members) == 0)
                <tr>
                    <td colspan="4">
                        <p class="text-center">Sin miembros ó seleccione una célula
                        </p>
                    </td>
                </tr>
                @else
                    @foreach ($members as $member)
                    <tr>
                        <td class="pe-0">
                            <div class="d-flex">
                                <div class="userDatatable__imgWrapper d-flex align-items-center m-0">
                                    <div class="checkbox-group-wrapper">
                                        <div class="checkbox-group d-flex">
                                            <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                                <input class="checkbox" type="checkbox" id="check-grp-{{ $member->id }}" name="attendance[]" value="{{ $member->id }}" {{  isset($cell_attendance->exists) && in_array($member->id, $cell_attendance->member_attendance) ? 'checked' : '' }}>
                                                <label for="check-grp-{{ $member->id }}" class="ps-0"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="userDatatable-content d-inline-block">
                                <span>{{ $member->full_name }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="userDatatable-content d-inline-block">
                                <span>{{ $member->age }}</span>
                            </div>
                        </td>
                        {{-- <td>
                            <div class="userDatatable-content d-inline-block">
                                <span>{{ date('d/m/Y', strtotime($member->member->birth_date)) }}</span>
                            </div>
                        </td> --}}
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
