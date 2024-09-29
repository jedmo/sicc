<div class="form-group-calender row mb-25 form-group-calender">
    <div class="col-md-8 mb-25">
        <div class="with-icon">
            <label for="date" class="color-dark fs-14 fw-500 align-center">Fecha</label>
            <div class="position-relative">
                <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15 input-date" name="date" id="date"
                value="{{ $report->date ? date('d/m/Y', strtotime($report->date)) : date('d/m/Y') }}" />
                <a href="#"><img class="svg" src="{{ asset('assets/img/svg/calendar.svg') }}" alt="calendar"></a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="total_attendance" class="color-dark fs-14 fw-500 align-center">Asistencia total</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="total_attendance" name="total_attendance"
            value="{{ $report->total_attendance }}" readonly />
        </div>
    </div>
</div>
<div class="form-group row mb-25">
    <h6>ADULTOS</h6>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="adult_sibling_attendance" class="color-dark fs-14 fw-500 align-center">Hermanos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="adult_sibling_attendance" name="adult_sibling_attendance"
            value="{{ $report->adult_sibling_attendance }}" />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="adult_friends_attendance" class="color-dark fs-14 fw-500 align-center">Amigos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="adult_friends_attendance" name="adult_friends_attendance"
            value="{{ $report->adult_friends_attendance }}" />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="total_adult_attendance" class="color-dark fs-14 fw-500 align-center">Total</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="total_adult_attendance" name="total_adult_attendance"
            value="{{ $report->total_adult_attendance }}" readonly />
        </div>
    </div>
</div>
<div class="form-group row mb-25">
    <h6>JÓVENES</h6>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="youth_sibling_attendance" class="color-dark fs-14 fw-500 align-center">Hermanos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="youth_sibling_attendance" name="youth_sibling_attendance"
            value="{{ $report->youth_sibling_attendance }}" />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="youth_friends_attendance" class="color-dark fs-14 fw-500 align-center">Amigos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="youth_friends_attendance" name="youth_friends_attendance"
            value="{{ $report->youth_friends_attendance }}" />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="total_youth_attendance" class="color-dark fs-14 fw-500 align-center">Total</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="total_youth_attendance" name="total_youth_attendance"
            value="{{ $report->total_youth_attendance }}" readonly />
        </div>
    </div>
</div>
<div class="form-group row mb-25">
    <h6>NIÑOS</h6>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="children_sibling_attendance" class="color-dark fs-14 fw-500 align-center">Hermanos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="children_sibling_attendance" name="children_sibling_attendance"
            value="{{ $report->children_sibling_attendance }}" />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="children_friends_attendance" class="color-dark fs-14 fw-500 align-center">Amigos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="children_friends_attendance" name="children_friends_attendance"
            value="{{ $report->children_friends_attendance }}" />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="total_children_attendance" class="color-dark fs-14 fw-500 align-center">Total</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="total_children_attendance" name="total_children_attendance"
            value="{{ $report->total_children_attendance }}" readonly />
        </div>
    </div>
</div>
<div class="form-group row mb-25">
    <h6>RESULTADOS</h6>
    <div class="col-md-3 mb-25">
        <div class="with-icon">
            <label for="conversions" class="color-dark fs-14 fw-500 align-center">Conversiones</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="conversions" name="conversions"
            value="{{ $report->conversions }}" />
        </div>
    </div>
    <div class="col-md-3 mb-25">
        <div class="with-icon">
            <label for="reconciliations" class="color-dark fs-14 fw-500 align-center">Reconcilios</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="reconciliations" name="reconciliations"
            value="{{ $report->reconciliations }}" />
        </div>
    </div>
    <div class="col-md-3 mb-25">
        <div class="with-icon">
            <label for="programmed_visits" class="color-dark fs-14 fw-500 align-center">Visitas P.</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="programmed_visits" name="programmed_visits"
            value="{{ $report->programmed_visits }}" />
        </div>
    </div>
    <div class="col-md-3 mb-25">
        <div class="with-icon">
            <label for="water_baptisms" class="color-dark fs-14 fw-500 align-center">Bautizmos</label>
            <input type="number" class="form-control ih-medium ip-light radius-xs b-light" id="water_baptisms" name="water_baptisms"
            value="{{ $report->water_baptisms }}" />
        </div>
    </div>
</div>
<div class="form-group row mb-25">
    <h6>OFRENDAS</h6>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="church_offering" class="color-dark fs-14 fw-500 align-center">Iglesia</label>
            <input type="text" class="form-control ih-medium ip-light radius-xs b-light" id="church_offering" name="church_offering"
            value="{{ $report->church_offering }}" placeholder="$" />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="offering_meter_by_meter" class="color-dark fs-14 fw-500 align-center">Metro a Metro</label>
            <input type="text" class="form-control ih-medium ip-light radius-xs b-light" id="offering_meter_by_meter" name="offering_meter_by_meter"
            value="{{ $report->offering_meter_by_meter }}" placeholder="$" />
        </div>
    </div>
    <div class="col-md-4 mb-25">
        <div class="with-icon">
            <label for="pro_bus_offering" class="color-dark fs-14 fw-500 align-center">Pro-Bus</label>
            <input type="text" class="form-control ih-medium ip-light radius-xs b-light" id="pro_bus_offering" name="pro_bus_offering"
            value="{{ $report->pro_bus_offering }}" placeholder="$" />
        </div>
    </div>
</div>
