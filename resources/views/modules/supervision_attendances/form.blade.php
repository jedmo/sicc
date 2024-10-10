<div class="form-group-calender row mb-25 form-group-calender">
    <div class="col-md-8 mb-25">
        <div class="with-icon">
            <label for="date" class="color-dark fs-14 fw-500 align-center">Fecha</label>
            <div class="position-relative">
                <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15 input-date" name="date" id="date"
                value="{{ $supervision_attendance->date ? date('d/m/Y', strtotime($supervision_attendance->date)) : date('d/m/Y') }}" />
                <a href="#"><img class="svg" src="{{ asset('assets/img/svg/calendar.svg') }}" alt="calendar"></a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="attendance" class="color-dark fs-14 fw-500 align-center">Total de asistentes</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="attendance" name="attendance"
            value="{{ $supervision_attendance->attendance }}" />
        </div>
    </div>
</div>
<input type="hidden" id="sector_id" name="sector_id" value="{{ $supervision_attendance->sector_id ?? $sector->id }}" />
<input type="hidden" id="zone_id" name="zone_id" value="{{ $supervision_attendance->zone_id ?? $sector->zone_id }}" />
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
                                                <input class="checkbox" type="checkbox" id="check-grp-{{ $member->id }}" name="member_attendance[]" value="{{ $member->id }}" {{  $supervision_attendance->exists && in_array($member->id, $supervision_attendance->member_attendance) ? 'checked' : '' }}>
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
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
