@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex align-items-center user-member__title mb-30 mt-30">
                    <h4 class="text-capitalize">{{ trans('menu.customer-add-new') }}</h4>
                </div>
            </div>
        </div>
        <div class="card mb-50">
            <div class="row justify-content-center">
                <div class="col-sm-7 col-10">
                    <div class="mt-40 mb-50">
                        <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="edit-profile__body">
                                @include('modules.roles.form')
                                <div class="button-group d-flex pt-25 justify-content-md-end justify-content-start">
                                    <a href="{{ route('roles.index') }}"
                                        class="btn btn-light btn-default btn-squared fw-400 text-capitalize m-sm-0 m-1">Cancelar</a>
                                    <button type="submit"
                                        class="btn btn-primary btn-default btn-squared radius-md shadow2 btn-sm">Crear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
