<div class="form-group row mb-25">
    <h6>Asistencia con la que inicia la célula</h6>
    <div class="col-md-4 mt-25">
        <div class="with-icon">
            <label for="child_attendance" class="color-dark fs-14 fw-500 align-center">Niños</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="child_attendance" name="child_attendance"
            value="{{ $initial->child_attendance }}" />
        </div>
    </div>
    <div class="col-md-4 mt-25">
        <div class="with-icon">
            <label for="young_attendance" class="color-dark fs-14 fw-500 align-center">Jovenes</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="young_attendance" name="young_attendance"
            value="{{ $initial->young_attendance }}" />
        </div>
    </div>
    <div class="col-md-4 mt-25">
        <div class="with-icon">
            <label for="adult_attendance" class="color-dark fs-14 fw-500 align-center">Adultos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="adult_attendance" name="adult_attendance"
            value="{{ $initial->adult_attendance }}" />
        </div>
    </div>
</div>