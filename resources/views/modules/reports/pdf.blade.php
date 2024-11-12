<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
 
    <link rel="stylesheet" href="{{ asset('pdf.css') }}" type="text/css"> 
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-header color-dark fw-500">
                        <h4>Reporte de célula</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered products">
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
                                                    <span>{{ $report->date }}</span>
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
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
