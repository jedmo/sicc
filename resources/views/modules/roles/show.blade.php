@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex align-items-center user-member__title mb-30 mt-30">
                <h4 class="text-capitalize">{{ trans('menu.customer-edit') }}</h4>
            </div>
        </div>
    </div>
    <div class="card mb-50">
        <div class="row justify-content-center">
            <div class="col-sm-5 col-10">
                <div class="mt-40 mb-50">
                    <div class="row">
                        <table class="table mb-0">
                            <tr>
                                <td><span class="userDatatable-title">Nombre</span></td>
                                <td><div class="userDatatable-content">{{ $role->name }}</div></td>
                            </tr>
                            <tr>
                                <td><span class="userDatatable-title">Permisos</span></td>
                                <td><div class="userDatatable-content">
                                    <div class="list-box">
                                        <ul>
                                            @if (!empty($role_permissions))
                                                @foreach ($role_permissions as $rp)
                                                    <li class="list-box__item">{{ $rp->name }}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div></td>
                            </tr>
                        </table>
                        <div class="button-group d-flex pt-25 justify-content-md-end justify-content-start">
                            <a href="{{ route('roles.index') }}"
                                class="btn btn-light btn-default btn-squared fw-400 text-capitalize m-sm-0 m-1">Atrás</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
