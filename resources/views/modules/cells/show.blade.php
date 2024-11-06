@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-header color-dark fw-500">
                    Célula {{ $cell->full_code }}
                </div>
                <div class="card-body">
                    <div class="tab-wrapper">
                        <div class="dm-tab tab-horizontal">
                            <ul class="nav nav-tabs vertical-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-v-1-tab" data-bs-toggle="tab" href="#tab-v-1"
                                        role="tab" aria-selected="true">Datos Generales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-v-2-tab" data-bs-toggle="tab" href="#tab-v-2" role="tab"
                                        aria-selected="false">Miembros</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-v-3-tab" data-bs-toggle="tab" href="#tab-v-3" role="tab"
                                        aria-selected="false">Evaluación</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-v-1" role="tabpanel"
                                    aria-labelledby="tab-v-1-tab">
                                    <div class="row justify-content-center">
                                        <div class="col-sm-7 col-10">
                                            <form action="{{ route('cells.update', $cell->id) }}" method="POST"
                                                enctype="multipart/form-data" class="was-validated">
                                                @csrf
                                                @method('PUT')
                                                <div class="edit-profile__body">
                                                    @include('modules.cells.form')
                                                    <div
                                                        class="button-group d-flex pt-25 justify-content-md-end justify-content-start">
                                                        <a href="{{ URL::previous() }}"
                                                            class="btn btn-light btn-default btn-squared fw-400 text-capitalize m-sm-0 m-1">Regresar</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-v-2" role="tabpanel" aria-labelledby="tab-v-2-tab">
                                    <div class="userDatatable global-shadow border-light-0 w-100">
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-borderless">
                                                <thead>
                                                    <tr class="userDatatable-header">
                                                        <th>
                                                            <span class="userDatatable-title">Nombre</span>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title">Sexo</span>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title">Edad</span>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title">Estado</span>
                                                        </th>
                                                        @hasanyrole('Admin|Líder')
                                                        <th>
                                                            <span class="userDatatable-title float-end">Acciones</span>
                                                        </th>
                                                        @endhasanyrole
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($members) == 0)
                                                    <tr>
                                                        <td colspan="7">
                                                            <p class="text-center">Sin mimebros</p>
                                                        </td>
                                                    </tr>
                                                    @else
                                                    @foreach ($members as $member)
                                                    <tr>
                                                        <td>
                                                            <div class="userDatatable-content d-inline-block">
                                                                <span>{{ $member->full_name }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="userDatatable-content d-inline-block">
                                                                <span>{{ $member->member->sex }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="userDatatable-content d-inline-block">
                                                                <span>{{ $member->age }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="userDatatable-content d-inline-block">
                                                                <span
                                                                    class="bg-opacity-{{ $member->member->status == 1 ? 'success' : 'warning' }}  color-{{ $member->member->status == 1 ? 'success' : 'warning' }} rounded-pill memberDatatable-content-status active">
                                                                    {{ $member->member->status == 1 ? 'Activo' :
                                                                    'Inactivo' }}
                                                                </span>
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
                                <div class="tab-pane fade" id="tab-v-3" role="tabpanel" aria-labelledby="tab-v-3-tab">
                                    <div class="row">
                                        <div class="col-xxl-3 col-lg-4 mb-25">
                                            <div class="card mt-25">
                                                <div class="card-body">
                                                    <h4>Quinquenio</h4> <br>
                                                    <div class="application-task d-flex align-items-center mb-25">
                                                        <div class="application-task-icon wh-60 bg-opacity-secondary content-center">
                                                            <img class="svg wh-25 text-secondary"
                                                                src="{{ asset('assets/img/svg/calendar.svg') }}"
                                                                alt="img">
                                                        </div>
                                                        <div class="application-task-content">
                                                            <h4>{{
                                                                Carbon\Carbon::parse($goals->start_period)->format('d-M-Y')
                                                                }}</h4>
                                                            <span
                                                                class="text-light fs-14 mt-1 text-capitalize">Inicio</span>
                                                        </div>
                                                    </div>
                                                    <div class="application-task d-flex align-items-center mb-25">
                                                        <div class="application-task-icon wh-60 bg-opacity-success content-center">
                                                            <img class="svg wh-25 text-success"
                                                                src="{{ asset('assets/img/svg/check-square.svg') }}"
                                                                alt="img">
                                                        </div>
                                                        <div class="application-task-content">
                                                            <h4>{{
                                                                Carbon\Carbon::now()->diffInYears($goals->start_period)
                                                                }}</h4>
                                                            <span class="text-light fs-14 mt-1 text-capitalize">Año
                                                                actual del periodo</span>
                                                        </div>
                                                    </div>
                                                    <div class="application-task d-flex align-items-center mb-25">
                                                        <div class="application-task-icon wh-60 bg-opacity-primary content-center">
                                                            <img class="svg wh-25 text-primary"
                                                                src="{{ asset('assets/img/svg/calendar.svg') }}"
                                                                alt="img">
                                                        </div>
                                                        <div class="application-task-content">
                                                            <h4>{{
                                                                Carbon\Carbon::parse($goals->end_period)->format('d-M-Y')
                                                                }}</h4>
                                                            <span
                                                                class="text-light fs-14 mt-1 text-capitalize">Fin</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-9 col-lg-8 mb-25">
                                            <div class="card border-0 px-25 h-100">
                                                <div class="card-header px-0 border-0">
                                                    <h6>Resultados</h6>
                                                </div>
                                                <div class="card-body p-0">
                                                    <div class="selling-table-wrap selling-table-wrap--source">
                                                        <div class="table-responsive">
                                                            <table class="table table--default table-borderless">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>Meta</th>
                                                                        <th>Acumulado</th>
                                                                        <th>Actual</th>
                                                                        <th class="text-center">Avance</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="selling-product-img d-flex align-items-center">
                                                                                <div class="selling-product-img-wrapper order-bg-opacity-primary">
                                                                                    <i class="uil uil-users-alt"></i>
                                                                                </div>
                                                                                <span>Asistencia</span>
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $goals->assistance }}</td>
                                                                        <td>-</td>
                                                                        <td>{{ $goals_control->assistance ?? 0 }}</td>
                                                                        <td>
                                                                            <div class="d-flex align-center mx-40">
                                                                                <div class="ratio-percentage me-15">{{ $goals_control->assistance_adv }}%
                                                                                </div>
                                                                                <div class="progress-wrap mb-0">
                                                                                    <div class="progress">
                                                                                        <div class="progress-bar bg-primary"
                                                                                            role="progressbar"
                                                                                            style="width: {{ $goals_control->assistance_adv }}%;"
                                                                                            aria-valuenow="{{ $goals_control->assistance_adv }}"
                                                                                            aria-valuemin="0"
                                                                                            aria-valuemax="100"></div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="selling-product-img d-flex align-items-center">
                                                                                <div class="selling-product-img-wrapper order-bg-opacity-primary">
                                                                                    <i class="uil uil-book-alt"></i>
                                                                                </div>
                                                                                <span>Conversiones</span>
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $goals->conversions }}</td>
                                                                        <td>{{ $goals_control->conversions ?? 0 }}</td>
                                                                        <td>-</td>
                                                                        <td>
                                                                            <div class="d-flex align-center mx-40">
                                                                                <div class="ratio-percentage me-15">{{ $goals_control->conversions_adv }}%
                                                                                </div>
                                                                                <div class="progress-wrap mb-0">
                                                                                    <div class="progress">
                                                                                        <div class="progress-bar bg-primary"
                                                                                            role="progressbar"
                                                                                            style="width: {{ $goals_control->conversions_adv }}%;"
                                                                                            aria-valuenow="{{ $goals_control->conversions_adv }}"
                                                                                            aria-valuemin="0"
                                                                                            aria-valuemax="100"></div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="selling-product-img d-flex align-items-center">
                                                                                <div class="selling-product-img-wrapper order-bg-opacity-facebook">
                                                                                    <i class="uil uil-water"></i>
                                                                                </div>
                                                                                <span>Bautismos en agua</span>
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $goals->baptisms }}</td>
                                                                        <td>{{ $goals_control->baptisms ?? 0 }}</td>
                                                                        <td>-</td>
                                                                        <td>
                                                                            <div class="d-flex align-center mx-40">
                                                                                <div class="ratio-percentage me-15">{{ $goals_control->baptisms_adv }}%
                                                                                </div>
                                                                                <div class="progress-wrap mb-0">
                                                                                    <div class="progress">
                                                                                        <div class="progress-bar bg-secondary"
                                                                                            role="progressbar"
                                                                                            style="width: {{ $goals_control->baptisms_adv }}%;"
                                                                                            aria-valuenow="{{ $goals_control->baptisms_adv }}"
                                                                                            aria-valuemin="0"
                                                                                            aria-valuemax="100"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="selling-product-img d-flex align-items-center">
                                                                                <div class="selling-product-img-wrapper order-bg-opacity-info">
                                                                                    <i class="uil uil-map-marker-edit"></i>
                                                                                </div>
                                                                                <span>Visitas Programadas</span>
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $goals->programmed_visits }}</td>
                                                                        <td>{{ $goals_control->programmed_visits ?? 0 }}</td>
                                                                        <td>-</td>
                                                                        <td>
                                                                            <div class="d-flex align-center mx-40">
                                                                                <div class="ratio-percentage me-15">{{ $goals_control->programmed_visits_adv }}%
                                                                                </div>
                                                                                <div class="progress-wrap mb-0">
                                                                                    <div class="progress">
                                                                                        <div class="progress-bar bg-info"
                                                                                            role="progressbar"
                                                                                            style="width: {{ $goals_control->programmed_visits_adv }}%;"
                                                                                            aria-valuenow="{{ $goals_control->programmed_visits_adv }}"
                                                                                            aria-valuemin="0"
                                                                                            aria-valuemax="100"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
