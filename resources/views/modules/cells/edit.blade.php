@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-header color-dark fw-500">
                    Editar célula
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-sm-7 col-10">
                            <form action="{{ route('cells.update', $cell->id) }}" method="POST"
                                enctype="multipart/form-data" class="was-validated">
                                @csrf
                                @method('PUT')
                                <div class="edit-profile__body">
                                    <div class="tab-wrapper">
                                        <div class="dm-tab tab-horizontal">
                                            <ul class="nav nav-tabs vertical-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="tab-v-1-tab" data-bs-toggle="tab" href="#tab-v-1"
                                                        role="tab" aria-selected="true">Datos Generales</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="tab-v-2-tab" data-bs-toggle="tab" href="#tab-v-2" role="tab"
                                                        aria-selected="false">Datos de inicio</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="tab-v-1" role="tabpanel" aria-labelledby="tab-v-1-tab">
                                                    @include('modules.cells.form')
                                                </div>
                                                <div class="tab-pane fade" id="tab-v-2" role="tabpanel" aria-labelledby="tab-v-2-tab">
                                                    @include('modules.cells.initial')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-group d-flex pt-25 justify-content-md-end justify-content-start">
                                        <a href="{{ route('cells.index') }}"
                                            class="btn btn-light btn-default btn-squared fw-400 text-capitalize m-sm-0 m-1">Cancelar</a>
                                        <button type="submit"
                                            class="btn btn-primary btn-default btn-squared radius-md shadow2 btn-sm">Actualizar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
