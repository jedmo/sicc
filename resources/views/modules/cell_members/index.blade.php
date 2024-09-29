@extends('layout.app')
@section('content')
    <div class="container-fluid">
        @hasanyrole('Administrador|Líder')
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-breadcrumb">
                    <div class="breadcrumb-main add-contact justify-content-sm-between ">
                        <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="action-btn mt-sm-0 mt-15">
                                <a href="{{ route('cell-members.create') }}" class="btn px-20 btn-primary ">
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
                        Miembros
                    </div>
                    <div class="card-body">
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
                                                <span class="userDatatable-title">Célula</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Nombre</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Edad</span>
                                            </th>
                                            {{-- <th>
                                                <span class="userDatatable-title">Conversión</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Bautizado en Agua</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Bautizado en E.S.</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Rute del Líder</span>
                                            </th> --}}
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
                                                {{-- @php
                                                    $conversion = false;
                                                    $bau_agua = false;
                                                    $bau_holy = false;
                                                    $ruta = false;
                                                    foreach ($member->tracking as $tracking) {
                                                        if ($tracking->step->value == 'Conversión') {
                                                            $conversion = true;
                                                        }
                                                        if ($tracking->step->value == 'Bautizado en agua') {
                                                            $bau_agua = true;
                                                        }
                                                        if ($tracking->step->value == 'Bautizado en Espíritu Santo') {
                                                            $bau_holy = true;
                                                        }
                                                        if ($tracking->step->value == 'Rute del Líder') {
                                                            $ruta = true;
                                                        }
                                                    }
                                                @endphp --}}
                                                <tr>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $member->cell->full_code }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $member->full_name }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $member->age }}</span>
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <i style="font-size: 18px" class="uil {{ $conversion ? 'uil-check-circle' : 'uil-info-circle'}}
                                                                color-{{ $conversion ? 'success' : 'warning' }}"></i>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <i style="font-size: 18px" class="uil {{ $bau_agua ? 'uil-check-circle' : 'uil-info-circle'}}
                                                                color-{{ $bau_agua ? 'success' : 'warning' }}"></i>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <i style="font-size: 18px" class="uil {{ $bau_holy ? 'uil-check-circle' : 'uil-info-circle'}}
                                                                color-{{ $bau_holy ? 'success' : 'warning' }}"></i>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <i style="font-size: 18px" class="uil {{ $ruta ? 'uil-check-circle' : 'uil-info-circle'}}
                                                                color-{{ $ruta ? 'success' : 'warning' }}"></i>
                                                        </div>
                                                    </td> --}}
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span
                                                                class="bg-opacity-{{ $member->member->status == 1 ? 'success' : 'warning' }}  color-{{ $member->member->status == 1 ? 'success' : 'warning' }} rounded-pill memberDatatable-content-status active">
                                                                {{ $member->member->status == 1 ? 'Activo' : 'Inactivo' }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    @hasanyrole('Admin|Líder')
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                            {{-- <li>
                                                                <a href="{{ route('trackings.show', $member->id) }}" class="view">
                                                                    <i class="uil uil-eye"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('trackings.create', $member->id) }}"
                                                                    class="edit">
                                                                    <i class="uil uil-folder-plus"></i>
                                                                </a>
                                                            </li> --}}
                                                            <li>
                                                                <a href="{{ route('cell-members.edit', $member->id) }}"
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
                                                                        if ( confirm('¿Desea remover el miembro?') ) {
                                                                            document.getElementById( 'delete-{{ $member->id }}' ).submit();
                                                                        }
                                                                    "
                                                                >
                                                                    <i class="uil uil-trash-alt"></i>
                                                                </a>

                                                                <form style="display:none;" id="delete-{{ $member->id }}"
                                                                    action="{{ route('cell-members.destroy', $member->id) }}"
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

                        <div class="pagination-container d-flex justify-content-end pt-25">
                            {{ $members->links( 'pagination::bootstrap-5' ) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
