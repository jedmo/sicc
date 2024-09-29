<div class="col-xxl-3 col-sm-6  col-ssm-12 mb-25">
    <!-- Card 1  -->
    <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
        <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
            <div class="ap-po-details__titlebar">
                <p>Asistencia</p>
                <h1>{{ $last_week_data['total_attendance'] }}</h1>
                <div class="ap-po-details-time">
                    <small>La última semana</small>
                </div>
            </div>
            <div class="ap-po-details__icon-area color-secondary">
                <i class="uil uil-users-alt"></i>
            </div>
        </div>
    </div>
    <!-- Card 1 End  -->
</div>

<div class="col-xxl-3 col-sm-6  col-ssm-12 mb-25">
    <!-- Card 2 -->
    <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
        <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
            <div class="ap-po-details__titlebar">
                <p>Ofrendas</p>
                <h1>${{ $last_week_data['church_offering'] }}</h1>
                <div class="ap-po-details-time">
                    <small>La última semana</small>
                </div>
            </div>
            <div class="ap-po-details__icon-area color-success">
                <i class="uil uil-usd-circle"></i>
            </div>
        </div>
    </div>
    <!-- Card 2 End  -->
</div>

<div class="col-xxl-3 col-sm-6  col-ssm-12 mb-25">
    <!-- Card 3 -->
    <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
        <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
            <div class="ap-po-details__titlebar">
                <p>Miembros Registrados</p>
                <h1>{{ count($last_week_data['members']) }}</h1>
                <div class="ap-po-details-time">
                    <small>Total</small>
                </div>
            </div>
            <div class="ap-po-details__icon-area color-primary">
                <i class="uil uil-arrow-growth"></i>
            </div>
        </div>
    </div>
    <!-- Card 3 End  -->
</div>

<div class="col-xxl-3 col-sm-6  col-ssm-12 mb-25">
    <!-- Card 4  -->
    <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
        <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
            <div class="ap-po-details__titlebar">
                <p>Porcentaje de avance</p>
                <h1>{{ number_format($last_week_data['goals_control']['assistance_adv'], 2) }}%</h1>
                <div class="ap-po-details-time">
                    <small>Meta de asistencia</small>
                </div>
            </div>
            <div class="ap-po-details__icon-area color-info">
                <i class="uil uil-tachometer-fast"></i>
            </div>
        </div>
    </div>
    <!-- Card 4 End  -->
</div>
