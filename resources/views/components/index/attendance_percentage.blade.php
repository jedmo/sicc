<div class="col-xxl-6 mb-25">

    <div class="card border-0 px-25 h-100">
        <div class="card-header px-0 border-0">
            <h6>Porcentaje de asistencia</h6>
        </div>
        <div class="p-0 card-body">
            <div class="revenueSourceChart px-0">
                <div class="parentContainer position-relative">
                    <div class="apexpie ms-md-n50">
                        <div id="attendance_percentage_graph"></div>
                    </div>
                </div>
                <div class="chart-content__details">
                    <div class="chart-content__single">
                        <span class="icon color-facebook">
                            A
                        </span>
                        <span class="label">Adultos</span>
                        <span class="data">{{ $last_week_data['total_adult_attendance'] }}</span>
                    </div>
                    <div class="chart-content__single">
                        <span class="icon color-twitter">
                            J
                        </span>
                        <span class="label">Jóvenes</span>
                        <span class="data">{{ $last_week_data['total_youth_attendance'] }}</span>
                    </div>
                    <div class="chart-content__single">
                        <span class="icon color-secondary">
                            N
                        </span>
                        <span class="label">Niños</span>
                        <span class="data">{{ $last_week_data['total_children_attendance'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
