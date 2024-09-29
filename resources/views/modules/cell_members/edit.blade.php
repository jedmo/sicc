@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex align-items-center user-member__title mb-30 mt-30">
                <h4 class="text-capitalize">Editar célula</h4>
            </div>
        </div>
    </div>
    <div class="card mb-50">
        <div class="card-body py-md-30">
            <div class="mt-40 mb-50">
                <form action="{{ route('cell-members.update', $cellMember->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('modules.cell_members.form')
                    <div class="button-group d-flex pt-25 justify-content-md-end justify-content-start">
                        <a href="{{ route('cell-members.index') }}"
                            class="btn btn-light btn-default btn-squared fw-400 text-capitalize m-sm-0 m-1">Cancelar</a>
                        <button type="submit"
                            class="btn btn-primary btn-default btn-squared radius-md shadow2 btn-sm">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
