<div class="form-group row mb-25">
    <h6>Líderes con los que inicia el sector</h6>
    <div class="col-md-4 mt-25">
        <div class="with-icon">
            <label for="child_leader" class="color-dark fs-14 fw-500 align-center">Niños</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="child_leader" name="child_leader"
            value="{{ $cell->child_leader }}" />
        </div>
    </div>
    <div class="col-md-4 mt-25">
        <div class="with-icon">
            <label for="young_leader" class="color-dark fs-14 fw-500 align-center">Jovenes</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="young_leader" name="young_leader"
            value="{{ $cell->young_leader }}" />
        </div>
    </div>
    <div class="col-md-4 mt-25">
        <div class="with-icon">
            <label for="adult_leader" class="color-dark fs-14 fw-500 align-center">Adultos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="adult_leader" name="adult_leader"
            value="{{ $cell->adult_leader }}" />
        </div>
    </div>
</div>
<div class="form-group row mb-25">
    <h6>Datos de asistencia con los que inicia el sector</h6>
    <div class="col-md-4 mt-25">
        <div class="with-icon">
            <label for="child_attendance" class="color-dark fs-14 fw-500 align-center">Niños</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="child_attendance" name="child_attendance"
            value="{{ $cell->child_attendance }}" />
        </div>
    </div>
    <div class="col-md-4 mt-25">
        <div class="with-icon">
            <label for="young_attendance" class="color-dark fs-14 fw-500 align-center">Jovenes</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="young_attendance" name="young_attendance"
            value="{{ $cell->young_attendance }}" />
        </div>
    </div>
    <div class="col-md-4 mt-25">
        <div class="with-icon">
            <label for="adult_attendance" class="color-dark fs-14 fw-500 align-center">Adultos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="adult_attendance" name="adult_attendance"
            value="{{ $cell->adult_attendance }}" />
        </div>
    </div>
</div>