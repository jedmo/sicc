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
                                    <a href="{{ route('supervision-attendances.create') }}" class="btn px-20 btn-primary ">
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
                        Asitencia a reunión de supervisión
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
                                            <a href="{{ route('supervision-attendances.index') }}" class="btn btn-info btn-default btn-rounded" style="margin: 5px 6px">
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
                        <div class="userDatatable global-shadow border-light-0 w-100">
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless">
                                    <thead>
                                        <tr class="userDatatable-header">
                                            <th>
                                                <span class="userDatatable-title">Zona</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Sector</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Fecha</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Total Asistencia</span>
                                            </th>
                                            @hasanyrole('Líder|Supervisor|Administrador')
                                            <th>
                                                <span class="userDatatable-title float-end">Acciones</span>
                                            </th>
                                            @endhasanyrole
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($attendances) == 0)
                                            <tr>
                                                <td colspan="5">
                                                    <p class="text-center">Sin asistencia</p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($attendances as $attendance)
                                                <tr>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $attendance['zone'] }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $attendance['sector'] }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $attendance['date'] }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $attendance['attendance'] }}</span>
                                                        </div>
                                                    </td>
                                                    @hasanyrole('Líder|Supervisor|Administrador')
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                            <li>
                                                                <a href="{{ route('supervision-attendances.edit', $attendance->id) }}"
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
                                                                            document.getElementById( 'delete-{{ $attendance->id }}' ).submit();
                                                                        }
                                                                    "
                                                                >
                                                                    <i class="uil uil-trash-alt"></i>
                                                                </a>

                                                                <form style="display:none;" id="delete-{{ $attendance->id }}"
                                                                    action="{{ route('supervision-attendances.destroy', $attendance->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </li>
                                                        </ul>
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
