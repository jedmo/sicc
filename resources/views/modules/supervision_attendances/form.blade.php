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
</div>
<div class="form-group row mb-25">
    <h6>ADULTOS</h6>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="zone_id" class="color-dark fs-14 fw-500 align-center">Zona</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="zone_id" name="zone_id"
            value="{{ $supervision_attendance->zone_id || $sector->zone_id }}" readonly />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="sector_id" class="color-dark fs-14 fw-500 align-center">Sector</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="sector_id" name="sector_id"
            value="{{ $supervision_attendance->sector_id || $sector->id }}" readonly />
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
