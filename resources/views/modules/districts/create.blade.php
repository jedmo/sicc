@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex align-items-center user-member__title mb-30 mt-30">
                <h4 class="text-capitalize">Agregar Distrito</h4>
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
        <div class="row justify-content-center">
            <div class="col-sm-5 col-10">
                <div class="mt-40 mb-50">
                    <form action="{{ route('districts.store') }}" method="POST" enctype="multipart/form-data"
                        class="was-validated">
                        @csrf

                        <div class="edit-profile__body">
                            @include('modules.districts.form')
                            <div class="button-group d-flex pt-25 justify-content-md-end justify-content-start">
                                <a href="{{ route('districts.index') }}"
                                    class="btn btn-light btn-default btn-squared fw-400 text-capitalize m-sm-0 m-1">Cancelar</a>
                                <button type="submit"
                                    class="btn btn-primary btn-default btn-squared radius-md shadow2 btn-sm">Crear</button>
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
@endsection
