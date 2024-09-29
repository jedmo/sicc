@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex align-items-center user-member__title mb-30 mt-30">
                <h4 class="text-capitalize">Agregar reporte de célula</h4>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class=" alert alert-success " role="alert">
        <div class="alert-content">
            {{ session('status') }}
        </div>
    </div>
    @endif
    <div class="card mb-50">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-10">
                    <div class="mt-40 mb-50">
                        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="edit-profile__body">
                                @if ($role == 'Líder')
                                <div class="form-group row mb-25">
                                    <div class="col-12">
                                        <h6>CÉLULA {{ $cells->full_code }}</h6>
                                        <input type="hidden" name="cell_id" value="{{ $cells->id }}" />
                                    </div>
                                </div>
                                @elseif ($role == 'Supervisor')
                                <div class="form-group row mb-25">
                                    <div class="col-12">
                                        <h6>SECTOR {{ $sectors->full_code }}</h6>
                                    </div>
                                    <div class="col-3">
                                        <label for="select-cell"
                                            class="il-gray fs-14 fw-500 align-center mb-10">Célula</label>
                                        <select name="cell_id" id="select-cell" class="form-control ">
                                            <option value="">Seleccione una célula</option>
                                            @forelse ($cells as $cell)
                                            <option value="{{ $cell->id }}">{{ $cell->code }}</option>
                                            @empty
                                            <option value="">Sin célula</option>
                                            @endforelse
                                        </select>
                                        @if ($errors->has('cell_id'))
                                        <p class="text-danger">{{ $errors->first('cell_id') }}</p>
                                        @endif
                                    </div>
                                </div>
                                @else
                                <div class="form-group row mb-25">
                                    <div class="col-3">
                                        <div class="dm-select ">
                                            <label for="select-district"
                                                class="il-gray fs-14 fw-500 align-center mb-10">Distrito</label>
                                            <select name="select-district" id="select-district" class="form-control ">
                                                @forelse ($districts as $district)
                                                <option value="{{ $district->id }}">{{ $district->full_code }}</option>
                                                @empty
                                                <option value="">Sin distrito</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="select-zone"
                                            class="il-gray fs-14 fw-500 align-center mb-10">Zona</label>
                                        <select name="select-zone" id="select-zone" class="form-control ">
                                            @forelse ($zones as $zone)
                                            <option value="{{ $zone->id }}">{{ $zone->full_code }}</option>
                                            @empty
                                            <option value="">Sin zona</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="select-sector"
                                            class="il-gray fs-14 fw-500 align-center mb-10">Sector</label>
                                        <select name="select-sector" id="select-sector" class="form-control ">
                                            @forelse ($sectors as $sector)
                                            <option value="{{ $sector->id }}">{{ $sector->full_code }}</option>
                                            @empty
                                            <option value="">Sin sector</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="select-cell"
                                            class="il-gray fs-14 fw-500 align-center mb-10">Célula</label>
                                        <select name="cell_id" id="select-cell" class="form-control ">
                                            @forelse ($cells as $cell)
                                            <option value="{{ $cell->id }}">{{ $cell->full_code }}</option>
                                            @empty
                                            <option value="">Sin célula</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <div class="tab-wrapper">
                                    <div class="dm-tab tab-horizontal">
                                        <ul class="nav nav-tabs vertical-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="tab-v-1-tab" data-bs-toggle="tab" href="#tab-v-1"
                                                    role="tab" aria-selected="true">Datos Generales</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab-v-2-tab" data-bs-toggle="tab" href="#tab-v-2" role="tab"
                                                    aria-selected="false">Asistencia</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tab-v-1" role="tabpanel"
                                                aria-labelledby="tab-v-1-tab">
                                                @include('modules.reports.form')
                                            </div>
                                            <div class="tab-pane fade" id="tab-v-2" role="tabpanel" aria-labelledby="tab-v-2-tab">
                                                @include('modules.reports.members')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-group d-flex pt-25 justify-content-md-end justify-content-start">
                                    <a href="{{ route('reports.index') }}"
                                        class="btn btn-light btn-default btn-squared fw-400 text-capitalize m-sm-0 m-1">Cancelar</a>
                                    <button type="submit"
                                        class="btn btn-primary btn-default btn-squared radius-md shadow2 btn-sm">Guardar</button>
                                </div>
                            </div>
                        </form>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            {{ $error }}
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
