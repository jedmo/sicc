@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-header color-dark fw-500">
                        Reportes de Sector
                        @hasrole('Supervisor')
                        <div class="col-md-2">
                            <h5>{{ $sectors['full_code'] }}</h5>
                        </div>
                        @endhasrole
                        <div class="card-extra">
                            <div class="dropdown  dropdown-click ">
                                <a class="btn btn-primary" href="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Exportar
                                    <img src="{{ asset('assets/img/svg/chevron-down.svg') }}" alt="chevron-down" class="svg">
                                </a>
                                <div class="dropdown-default dropdown-menu">
                                    <a class="dropdown-item" href="#">Excel</a>
                                    <a class="dropdown-item" href="#">PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-wrapper">
                            <div class="dm-tab tab-horizontal">
                                <ul class="nav nav-tabs vertical-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab-v-1-tab" data-bs-toggle="tab" href="#tab-v-1"
                                            role="tab" aria-selected="true">Promedios</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab-v-2-tab" data-bs-toggle="tab" href="#tab-v-2" role="tab"
                                            aria-selected="false">Semanal</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tab-v-1" role="tabpanel" aria-labelledby="tab-v-1-tab">
                                        <form method="GET">
                                            <div class="row">
                                                @hasanyrole('Pastor de Zona|Pastor de Distrito|Pastor General|Administrador')
                                                <div class="col-md-2">
                                                    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="sector_id" id="sector_id">
                                                        <option value="">Seleccione</option>
                                                        @foreach ( $sectors as $sector )
                                                            <option value="{{ $sector['id'] }}" {{ $sector_id == $sector['id'] ? 'selected' : '' }}>
                                                                {{ $sector['full_code'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endhasanyrole
                                                <div class="col-md-2">
                                                    <input type="text" name="start_date" id="start_date" class="form-control ih-medium ip-gray radius-xs b-light px-15 input-date"
                                                    placeholder="Fecha inicio" autocomplete="off" spellcheck="false" value="{{ $start_date }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" name="end_date" id="end_date" class="form-control ih-medium ip-gray radius-xs b-light px-15 input-date"
                                                    placeholder="Fecha fin" autocomplete="off" spellcheck="false" value="{{ $end_date }}">
                                                </div>
                                                <div class="col-md-3 dm-button-list d-flex flex-wrap">
                                                    <div class="action-btn mt-sm-0 mt-15">
                                                        <button class="btn btn-secondary btn-default btn-rounded" type="submit">
                                                            <i class="las la-search fs-16"></i>Filtrar
                                                        </button>
                                                    </div>
                                                    @if ($start_date)
                                                        <div class="action-btn mt-sm-0 mt-15">
                                                            <a href="{{ route('reports.sectors') }}" class="btn btn-info btn-default btn-rounded" style="margin: 5px 6px">
                                                                Quitar filtro
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="tab-v-2" role="tabpanel" aria-labelledby="tab-v-2-tab">
                                        <form method="GET">
                                            <div class="row">
                                                @hasanyrole('Pastor de Zona|Pastor de Distrito|Pastor General|Administrador')
                                                <div class="col-md-2">
                                                    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="sector_id" id="sector_id">
                                                        <option value="">Seleccione</option>
                                                        @foreach ( $sectors as $sector )
                                                            <option value="{{ $sector['id'] }}" {{ $sector_id == $sector['id'] ? 'selected' : '' }}>
                                                                {{ $sector['full_code'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endhasanyrole
                                                <div class="col-md-3">
                                                    <input type="text" name="date" id="date" class="form-control ih-medium ip-gray radius-xs b-light px-15 week-picker"
                                                    placeholder="Seleccionar semana" autocomplete="off" spellcheck="false" value="{{ $date }}">
                                                </div>
                                                <div class="col-md-3 dm-button-list d-flex flex-wrap">
                                                    <div class="action-btn mt-sm-0 mt-15">
                                                        <button class="btn btn-secondary btn-default btn-rounded" type="submit">
                                                            <i class="las la-search fs-16"></i>Filtrar
                                                        </button>
                                                    </div>
                                                    @if ($start_date)
                                                        <div class="action-btn mt-sm-0 mt-15">
                                                            <a href="{{ route('reports.sectors') }}" class="btn btn-info btn-default btn-rounded" style="margin: 5px 6px">
                                                                Quitar filtro
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                                <span class="userDatatable-title">Célula</span>
                                            </th>
                                            <th rowspan="2" colspan="3">
                                                <span class="userDatatable-title">Tipo</span>
                                            </th>
                                            <th rowspan="3">
                                                <span class="userDatatable-title">Lider</span>
                                            </th>
                                            <th colspan="10" class="text-center">
                                                <span class="userDatatable-title">Asistencia</span>
                                            </th>
                                            <th colspan="3" rowspan="2" class="text-center">
                                                <span class="userDatatable-title">Ofrendas</span>
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
                                            <th><span class="userDatatable-title">A</span></th>
                                            <th><span class="userDatatable-title">J</span></th>
                                            <th><span class="userDatatable-title">N</span></th>
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
                                                <span class="userDatatable-title">Igl.</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">P. Bus</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">M. a M.</span>
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
                                        @if (count($reports) == 0)
                                            <tr>
                                                <td colspan="15">
                                                    <p class="text-center">Seleccione un sector y una semana para visualizar reportes</p>
                                                </td>
                                            </tr>
                                        @else
                                        @foreach ($reports as $report)
                                            <tr>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block text-nowrap">
                                                        <span>{{ $report->cell->full_code }} </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report->cell->type == 'Adultos' ? 'X' : '' }} </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report->cell->type == 'Jóvenes' ? 'X' : '' }} </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>{{ $report->cell->type == 'Niños' ? 'X' : '' }} </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block text-nowrap">
                                                        <span>{{ $report->cell->leader->full_name }}</span>
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
                                                        <span>${{ $report['church_offering'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>${{ $report['pro_bus_offering'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="userDatatable-content d-inline-block">
                                                        <span>${{ $report['offering_meter_by_meter'] }}</span>
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
                                                <td><b>Total</b></td>
                                                <td><b>{{ $sum_reports['total_adult_leader'] }}</b></td>
                                                <td><b>{{ $sum_reports['total_youth_leader'] }}</b></td>
                                                <td><b>{{ $sum_reports['total_children_leader'] }}</b></td>
                                                <td></td>
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
                                                <td><b>${{ number_format($sum_reports['total_church_offering'], 2) }}</b></td>
                                                <td><b>${{ number_format($sum_reports['total_pro_bus_offering'], 2) }}</b></td>
                                                <td><b>${{ number_format($sum_reports['total_offering_meter_by_meter'], 2) }}</b></td>
                                                <td><b>{{ $sum_reports['total_conversions'] }}</b></td>
                                                <td><b>{{ $sum_reports['total_reconciliations'] }}</b></td>
                                            </tr>
                                            @if ($avg)
                                                <tr>
                                                    <td><b>Promedios</b></td>
                                                    <td><b>-</b></td>
                                                    <td><b>-</b></td>
                                                    <td><b>-</b></td>
                                                    <td></td>
                                                    <td><b>{{ number_format(($sum_reports['adult_sibling_attendance'] / count($reports)), 2) }}</b></td>
                                                    <td><b>{{ number_format(($sum_reports['adult_friends_attendance'] / count($reports)), 2) }}</b></td>
                                                    <td><b>{{ number_format(($sum_reports['total_adult_attendance'] / count($reports)), 2) }}</b></td>
                                                    <td><b>{{ number_format(($sum_reports['youth_sibling_attendance'] / count($reports)), 2) }}</b></td>
                                                    <td><b>{{ number_format(($sum_reports['youth_friends_attendance'] / count($reports)), 2) }}</b></td>
                                                    <td><b>{{ number_format(($sum_reports['total_youth_attendance'] / count($reports)), 2) }}</b></td>
                                                    <td><b>{{ number_format(($sum_reports['children_sibling_attendance'] / count($reports)), 2) }}</b></td>
                                                    <td><b>{{ number_format(($sum_reports['children_friends_attendance'] / count($reports)), 2) }}</b></td>
                                                    <td><b>{{ number_format(($sum_reports['total_children_attendance'] / count($reports)), 2) }}</b></td>
                                                    <td><b>{{ number_format(($sum_reports['total_attendance'] / count($reports)), 2) }}</b></td>
                                                    <td><b>${{ number_format(($sum_reports['total_church_offering'] / count($reports)), 2) }}</b></td>
                                                    <td><b>${{ number_format(($sum_reports['total_pro_bus_offering'] / count($reports)), 2) }}</b></td>
                                                    <td><b>${{ number_format(($sum_reports['total_offering_meter_by_meter'] / count($reports)), 2) }}</b></td>
                                                    <td><b>-</b></td>
                                                    <td><b>-</b></td>
                                                </tr>
                                            @endif
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
