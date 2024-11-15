@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-header color-dark fw-500">
                    Agregar Evento ó Actividad
                </div>
                <div class="card-body">
                    <div class="tab-wrapper">
                        @if(session('status'))
                        <div class=" alert alert-success " role="alert">
                            <div class="alert-content">
                                {{ session('status') }}
                            </div>
                        </div>
                        @endif
                        <div class="row justify-content-center">
                            <div class="col-sm-7 col-10">
                                <div class="mt-40 mb-50">
                                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="was-validated">
                                        @csrf
                                        <div class="edit-profile__body">
                                            @include('modules.events.form')
                                            <div class="button-group d-flex pt-25 justify-content-md-end justify-content-start">
                                                <a href="{{ route('events.index') }}" class="btn btn-light btn-default btn-squared fw-400 text-capitalize m-sm-0 m-1">Cancelar</a>
                                                <button type="submit" class="btn btn-primary btn-default btn-squared radius-md shadow2 btn-sm">Agregar</button>
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
    </div>
</div>
@endsection
