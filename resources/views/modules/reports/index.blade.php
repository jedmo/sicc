@extends('layout.app')
@section('content')
    <div class="container-fluid">
        @hasanyrole('Líder|Supervisor|Administrador')
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-breadcrumb">
                        <div class="breadcrumb-main add-contact justify-content-sm-between ">
                            <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                                <div class="action-btn mt-sm-0 mt-15">
                                    <a href="{{ route('reports.create') }}" class="btn px-20 btn-primary ">
                                        <i class="las la-plus fs-16"></i>Agregar nuevo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endhasanyrole
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-header color-dark fw-500">
                        <h4>Reporte de célula</h4>
                        <div class="card-extra">
                            <div class="dropdown  dropdown-click ">
                                <a class="btn btn-outline-primary" href="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="las la-angle-down"></i>
                                    Exportar
                                </a>
                                <div class="dropdown-default dropdown-menu">
                                    <a class="dropdown-item" href="#">Excel</a>
                                    <a class="dropdown-item" href="{{ route('report.pdf', 735) }}" target="_blank">PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @unlessrole('Líder')
                        <form method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="cell_id" id="cell_id">
                                        <option value="">Seleccione</option>
                                        @foreach ( $cells as $cell )
                                            <option value="{{ $cell['id'] }}" {{ $cell_id == $cell['id'] ? 'selected' : '' }}>
                                                {{ $cell['full_code'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 dm-button-list d-flex flex-wrap">
                                    <div class="action-btn mt-sm-0 mt-15">
                                        <button class="btn btn-secondary btn-default btn-rounded" type="submit">
                                            <i class="las la-search fs-16"></i>Filtrar
                                        </button>
                                    </div>
                                    @if ($cell_id)
                                        <div class="action-btn mt-sm-0 mt-15">
                                            <a href="{{ route('reports.index') }}" class="btn btn-info btn-default btn-rounded" style="margin: 5px 6px">
                                                Quitar filtro
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                        @endunlessrole
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
                                <table class="table mb-0 table-bordered table-social">
                                    <thead>
                                        <tr>
                                            @hasanyrole('Supervisor|Pastor de Zona')
                                            <th rowspan="3">
                                                <span class="userDatatable-title">Célula</span>
                                            </th>
                                            <th rowspan="3">
                                                <span class="userDatatable-title">Líder</span>
                                            </th>
                                            @endhasanyrole
                                            <th rowspan="3">
                                                <span class="userDatatable-title">Fecha</span>
                                            </th>
                                            <th colspan="10" class="text-center">
                                                <span class="userDatatable-title">Asistencia</span>
                                            </th>
                                            <th colspan="3" rowspan="2" class="text-center">
                                                <span class="userDatatable-title">Ofrendas</span>
                                            </th>
                                            <th colspan="4" rowspan="2" class="text-center">
                                                <span class="userDatatable-title">Resultados</span>
                                            </th>
                                            <th colspan="3" rowspan="2" class="text-center">
                                                <span class="userDatatable-title">Asistencia al templo</span>
                                            </th>
                                            @hasanyrole('Líder|Supervisor|Administrador')
                                                <th rowspan="3">
                                                    <span class="userDatatable-title float-end">Acciones</span>
                                                </th>
                                            @endhasanyrole
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
                                            <th>
                                                <span class="userDatatable-title">Visitas Prog.</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Bautismos en Agua</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">D1</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">D2</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Dom</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($reports) == 0)
                                            <tr>
                                                <td colspan="7">
                                                    <p class="text-center">Sin reportes</p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($reports as $report)
                                                <tr>
                                                    @hasanyrole('Supervisor|Pastor de Zona')
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block text-nowrap">
                                                            <span>{{ $report->cell->full_code }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block text-nowrap">
                                                            <span>{{ $report->cell->leader->full_name }}</span>
                                                        </div>
                                                    </td>
                                                    @endhasanyrole
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block text-nowrap">
                                                            <span>{{ Carbon\Carbon::parse($report->date)->format('d-m-y') }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->adult_sibling_attendance }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->adult_friends_attendance }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->total_adult_attendance }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->youth_sibling_attendance }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->youth_friends_attendance }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->total_youth_attendance }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->children_sibling_attendance }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->children_friends_attendance }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->total_children_attendance }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->total_attendance }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>${{ $report->church_offering }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>${{ $report->pro_bus_offering }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>${{ $report->offering_meter_by_meter }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->conversions }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->reconciliations }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->programmed_visits }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->water_baptisms }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->total_attendance_1d }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->total_attendance_2d }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $report->total_attendance_sd }}</span>
                                                        </div>
                                                    </td>
                                                    @if (\Carbon\Carbon::parse($report->date)->toDate() >= $limit_date)
                                                        @hasanyrole('Líder|Supervisor|Administrador')
                                                            <td>
                                                                <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                                    <li>
                                                                        <a href="{{ route('reports.edit', $report->id) }}"
                                                                            class="edit">
                                                                            <i class="uil uil-edit"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a
                                                                            href="#"
                                                                            class="remove"
                                                                            onclick="
                                                                                event.preventDefault();
                                                                                if ( confirm('¿Desea eliminar el reporte?') ) {
                                                                                    document.getElementById( 'delete-{{ $report->id }}' ).submit();
                                                                                }
                                                                            "
                                                                        >
                                                                            <i class="uil uil-trash-alt"></i>
                                                                        </a>

                                                                        <form style="display:none;" id="delete-{{ $report->id }}"
                                                                            action="{{ route('reports.destroy', $report->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('delete')
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        @endhasanyrole
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination-container d-flex justify-content-end pt-25">
                            {{ $reports->links( 'pagination::bootstrap-5' ) }}

                            <ul class="dm-pagination d-flex">
                                <li class="dm-pagination__item">
                                    <div class="paging-option">
                                        <select name="page-number" class="page-selection" onchange="updatePagination( event )">
                                            <option value="10" {{ 10 == $reports->perPage() ? 'selected' : '' }}>10/página</option>
                                            <option value="20" {{ 20 == $reports->perPage() ? 'selected' : '' }}>20/página</option>
                                            <option value="50" {{ 50 == $reports->perPage() ? 'selected' : '' }}>50/página</option>
                                        </select>
                                        <a href="/pagination-per-page/20" class="d-none per-page-pagination"></a>
                                    </div>
                                </li>
                            </ul>

                            <script>
                                function updatePagination( event ) {
                                    var per_page = event.target.value;

                                    const per_page_link = document.querySelector( '.per-page-pagination' );
                                    per_page_link.setAttribute( 'href', '/pagination-per-page/' + per_page  );

                                    per_page_link.click();
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
