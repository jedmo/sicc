<div class="form-group-calender row mb-25 form-group-calender">
    <h6>SEMANA</h6>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="start_date" class="color-dark fs-14 fw-500 align-center">Desde</label>
            <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15" name="start_date" id="start_date"
            value="{{ $church_attendance->start_date ? date('d/m/Y', strtotime($church_attendance->start_date)) : date('d/m/Y') }}" readonly />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="end_date" class="color-dark fs-14 fw-500 align-center">Hasta</label>
            <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15" name="end_date" id="end_date"
            value="{{ $church_attendance->end_date ? date('d/m/Y', strtotime($church_attendance->end_date)) : date('d/m/Y') }}" readonly />
        </div>
    </div>
</div>
<div class="form-group row mb-25">
    <h6>DÍA 1</h6>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="sibling_attendance_1d" class="color-dark fs-14 fw-500 align-center">Hermanos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="sibling_attendance_1d" name="sibling_attendance_1d"
            value="{{ $church_attendance->sibling_attendance_1d }}" />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="friends_attendance_1d" class="color-dark fs-14 fw-500 align-center">Amigos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="friends_attendance_1d" name="friends_attendance_1d"
            value="{{ $church_attendance->friends_attendance_1d }}" />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="total_attendance_1d" class="color-dark fs-14 fw-500 align-center">Total</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="total_attendance_1d" name="total_attendance_1d"
            value="{{ $church_attendance->total_attendance_1d }}" readonly />
        </div>
    </div>
</div>
<div class="form-group row mb-25">
    <h6>DÍA 2</h6>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="sibling_attendance_2d" class="color-dark fs-14 fw-500 align-center">Hermanos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="sibling_attendance_2d" name="sibling_attendance_2d"
            value="{{ $church_attendance->sibling_attendance_2d }}" />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="friends_attendance_2d" class="color-dark fs-14 fw-500 align-center">Amigos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="friends_attendance_2d" name="friends_attendance_2d"
            value="{{ $church_attendance->friends_attendance_2d }}" />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="total_attendance_2d" class="color-dark fs-14 fw-500 align-center">Total</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="total_attendance_2d" name="total_attendance_2d"
            value="{{ $church_attendance->total_attendance_2d }}" readonly />
        </div>
    </div>
</div>
<div class="form-group row mb-25">
    <h6>DOMINGO</h6>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="sibling_attendance_sd" class="color-dark fs-14 fw-500 align-center">Hermanos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="sibling_attendance_sd" name="sibling_attendance_sd"
            value="{{ $church_attendance->sibling_attendance_sd }}" />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="friends_attendance_sd" class="color-dark fs-14 fw-500 align-center">Amigos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="friends_attendance_sd" name="friends_attendance_sd"
            value="{{ $church_attendance->friends_attendance_sd }}" />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="total_attendance_sd" class="color-dark fs-14 fw-500 align-center">Total</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="total_attendance_sd" name="total_attendance_sd"
            value="{{ $church_attendance->total_attendance_sd }}" readonly />
        </div>
    </div>
    <div class="col-md-4 mb-25 offset-md-8">
        <div class="with-icon">
            <label for="total_attendance_week" class="color-dark fs-14 fw-500 align-center">Asistencia total</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="total_attendance_week" name="total_attendance_week"
            value="{{ $church_attendance->total_attendance_week }}" readonly />
        </div>
    </div>
</div>
