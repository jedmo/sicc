@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="alert-icon-big alert alert-info mt-30" role="alert">
            <div class="alert-icon">
                <img src="{{ asset('assets/img/svg/layers.svg') }}" alt="layers" class="svg">
            </div>
            <div class="alert-content">
                <p>Solo se permite agregar o actualizar la asistencia al templo durante la semana actual.</p>
            </div>
        </div>
        @hasanyrole('Líder|Supervisor|Administrador')
            <div class="row">
                @if (count($church_attendances) > 0 && Carbon\Carbon::now()->diffInDays($church_attendances[0]->start_date) > 7)
                <div class="col-lg-12">
                    <div class="contact-breadcrumb">
                        <div class="breadcrumb-main add-contact justify-content-sm-between ">
                            <div class="action-btn mt-sm-0 mt-15">
                                <a href="{{ route('church-attendances.create') }}" class="btn px-20 btn-primary ">
                                    <i class="las la-plus fs-16"></i>Agregar nuevo
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        @endhasanyrole
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-header color-dark fw-500">
                        Asitencia al templo
                    </div>
                    <div class="card-body">
                        @unlessrole('Líder')
                        <form method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" id="date" class="form-control ih-medium ip-gray radius-xs b-light px-15 week-picker" name="week"
                                        placeholder="Seleccione semana" autocomplete="off" spellcheck="false">
                                </div>
                                <div class="col-md-4 dm-button-list d-flex flex-wrap">
                                    <div class="action-btn mt-sm-0 mt-15">
                                        <button class="btn btn-secondary btn-default btn-rounded" type="submit">
                                            <i class="las la-search fs-16"></i>Filtrar
                                        </button>
                                    </div>
                                    @if ($week)
                                        <div class="action-btn mt-sm-0 mt-15">
                                            <a href="{{ route('church-attendances.index') }}" class="btn btn-info btn-default btn-rounded" style="margin: 5px 6px">
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
                        <div class="userDatatable global-shadow border-light-0 w-100">
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless">
                                    <thead>
                                        <tr class="userDatatable-header">
                                            <th>
                                                <span>Semana</span>
                                            </th>
                                            @hasanyrole('Líder|Supervisor|Administrador')
                                            <th>
                                                <span>Célula</span>
                                            </th>
                                            @endhasrole
                                            @hasrole('Pastor de Zona')
                                            <th>
                                                <span>Sector</span>
                                            </th>
                                            @endhasrole
                                            <th>
                                                <span>Día 1</span>
                                            </th>
                                            <th>
                                                <span>Día 2</span>
                                            </th>
                                            <th>
                                                <span>Domingo</span>
                                            </th>
                                            <th>
                                                <span>Total de la semana</span>
                                            </th>
                                            @hasanyrole('Líder|Supervisor|Administrador')
                                            <th>
                                                <spanfloat-end">Acciones</span>
                                            </th>
                                            @endhasanyrole
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($church_attendances) == 0)
                                            <tr>
                                                <td colspan="8">
                                                    <p class="text-center">Sin asistencia</p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($church_attendances as $church_attendance)
                                                <tr>
                                                    <td>
                                                        {{ Carbon\Carbon::parse($church_attendance->start_date)->format('d/m/y') }} - {{ Carbon\Carbon::parse($church_attendance->end_date)->format('d/m/y') }}
                                                    </td>
                                                    <td>
                                                        @hasanyrole('Líder|Supervisor|Administrador')
                                                        <span>{{ $church_attendance->cell->full_code }}</span>
                                                        @endhasanyrole
                                                        @hasrole('Pastor de Zona')
                                                        <span>{{ $church_attendance['full_code'] }}</span>
                                                        @endhasrole
                                                    </td>
                                                    <td>
                                                        <span>{{ $church_attendance['total_attendance_1d'] }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $church_attendance['total_attendance_2d'] }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $church_attendance['total_attendance_sd'] }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $church_attendance['total_attendance_week'] }}</span>
                                                    </td>
                                                    @hasanyrole('Líder|Supervisor|Administrador')
                                                    <td>
                                                        @if ( $church_attendance->end_date >= Carbon\Carbon::now()->startOfWeek() && $church_attendance->end_date <= Carbon\Carbon::now()->endOfWeek() )
                                                            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                                <li>
                                                                    <a href="{{ route('church-attendances.edit', $church_attendance->id) }}"
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
                                                                                document.getElementById( 'delete-{{ $church_attendance->id }}' ).submit();
                                                                            }
                                                                        "
                                                                    >
                                                                        <i class="uil uil-trash-alt"></i>
                                                                    </a>

                                                                    <form style="display:none;" id="delete-{{ $church_attendance->id }}"
                                                                        action="{{ route('church-attendances.destroy', $church_attendance->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        @endif
                                                    </td>
                                                    @endhasanyrole
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
        </div>
    </div>
@endsection
