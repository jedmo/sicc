@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-header color-dark fw-500">
                        Reporte Estadístico General
                    </div>
                    <div class="card-body">
                        <form action="{{ route('reports.stat-general') }}" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="date" id="date" class="form-control ih-medium ip-gray radius-xs b-light px-15 week-picker"
                                    placeholder="Seleccione semana" autocomplete="off" spellcheck="false" value="{{ $date }}">
                                </div>
                                <div class="col-md-4 dm-button-list d-flex flex-wrap">
                                    <div class="action-btn mt-sm-0 mt-15">
                                        <button class="btn btn-secondary btn-default btn-rounded" type="submit">
                                            <i class="las la-search fs-16"></i>Filtrar
                                        </button>
                                    </div>
                                    @if ($date)
                                        <div class="action-btn mt-sm-0 mt-15">
                                            <a href="{{ route('reports.stat-general') }}" class="btn btn-info btn-default btn-rounded" style="margin: 5px 6px">
                                                Quitar filtro
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                        @if ($message = Session::get('success'))
                            <div class=" alert alert-success " role="alert">
                                <div class="alert-content">
                                    <p>{{ $message }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="global-shadow border-light-0 w-100">
                            <div class="table-responsive">
                                <table class="table mb-0 table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="3">
                                                <span class="userDatatable-title">Distrito</span>
                                            </th>
                                            <th rowspan="3">
                                                <span class="userDatatable-title">Pastor</span>
                                            </th>
                                            <th rowspan="2" colspan="5">
                                                <span class="userDatatable-title">Lideres</span>
                                            </th>
                                            <th colspan="10" class="text-center">
                                                <span class="userDatatable-title">Asistencia</span>
                                            </th>
                                            <th colspan="2" rowspan="2" class="text-center">
                                                <span class="userDatatable-title">Resultados</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="3">
                                                <span class="userDatatable-title">Adultos</span>
                                            </th>
                                            <th colspan="3">
                                                <span class="userDatatable-title">Jóvenes</span>
                                            </th>
                                            <th colspan="3">
                                                <span class="userDatatable-title">Niños</span>
                                            </th>
                                            <th rowspan="2">
                                                <span class="userDatatable-title">Total</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th><span class="userDatatable-title">A</span></th>
                                            <th><span class="userDatatable-title">J</span></th>
                                            <th><span class="userDatatable-title">N</span></th>
                                            <th><span class="userDatatable-title">Total</span></th>
                                            <th>
                                                <span class="userDatatable-title">Hnos</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Amg.</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Suma</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Hnos</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Amg.</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Suma</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Hnos</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Amg.</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Suma</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Conv.</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Rec.</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($grouped_reports) == 0)
                                            <tr>
                                                <td colspan="12">
                                                    <p class="text-center">Sin reportes</p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($grouped_reports as $report)
                                            <tr>
                                                <td rowspan="6">
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['full_code'] }} </span>
                                                    </div>
                                                </td>
                                                <td rowspan="6">
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['pastor'] }}</span>
                                                    </div>
                                                </td>
                                                <td>Inicio</td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_adult_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_youth_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_children_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_leaders'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['adult_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['adult_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_adult_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['youth_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['youth_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_youth_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['children_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['children_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_children_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['conversions'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['reconciliations'] }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Meta</td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_adult_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_youth_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_children_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_leaders'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['adult_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['adult_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_adult_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['youth_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['youth_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_youth_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['children_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['children_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_children_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['conversions'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['reconciliations'] }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Activos</td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_adult_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_youth_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_children_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_leaders'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['adult_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['adult_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_adult_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['youth_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['youth_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_youth_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['children_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['children_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_children_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['conversions'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['reconciliations'] }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Reportados</td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_adult_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_youth_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_children_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_leaders'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['adult_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['adult_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_adult_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['youth_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['youth_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_youth_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['children_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['children_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_children_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['conversions'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['reconciliations'] }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Diferencia</td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_adult_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_youth_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_children_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_leaders'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['adult_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['adult_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_adult_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['youth_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['youth_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_youth_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['children_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['children_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_children_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['conversions'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['reconciliations'] }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Estado %</td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_adult_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_youth_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_children_leader'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_leaders'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['adult_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['adult_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_adult_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['youth_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['youth_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_youth_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['children_sibling_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['children_friends_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_children_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['total_attendance'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['conversions'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report['reconciliations'] }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3"><b>Total</b></td>
                                                <td><b>{{ $sum_reports['total_adult_leader'] }}</b></td>
                                                <td><b>{{ $sum_reports['total_youth_leader'] }}</b></td>
                                                <td><b>{{ $sum_reports['total_children_leader'] }}</b></td>
                                                <td><b>{{ $sum_reports['total_leaders'] }}</b></td>
                                                <td><b>{{ $sum_reports['adult_sibling_attendance'] }}</b></td>
                                                <td><b>{{ $sum_reports['adult_friends_attendance'] }}</b></td>
                                                <td><b>{{ $sum_reports['total_adult_attendance'] }}</b></td>
                                                <td><b>{{ $sum_reports['youth_sibling_attendance'] }}</b></td>
                                                <td><b>{{ $sum_reports['youth_friends_attendance'] }}</b></td>
                                                <td><b>{{ $sum_reports['total_youth_attendance'] }}</b></td>
                                                <td><b>{{ $sum_reports['children_sibling_attendance'] }}</b></td>
                                                <td><b>{{ $sum_reports['children_friends_attendance'] }}</b></td>
                                                <td><b>{{ $sum_reports['total_children_attendance'] }}</b></td>
                                                <td><b>{{ $sum_reports['total_attendance'] }}</b></td>
                                                <td><b>{{ $sum_reports['total_conversions'] }}</b></td>
                                                <td><b>{{ $sum_reports['total_reconciliations'] }}</b></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
