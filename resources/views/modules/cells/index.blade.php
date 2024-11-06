@extends('layout.app')
@section('content')
    <div class="container-fluid">
        @hasrole('Administrador|Supervisor')
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-breadcrumb">
                    <div class="breadcrumb-main add-contact justify-content-sm-between ">
                        <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="action-btn mt-sm-0 mt-15">
                                <a href="{{ route('cells.create') }}" class="btn px-20 btn-primary ">
                                    <i class="las la-plus fs-16"></i>Agregar nueva
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endhasrole
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-header color-dark fw-500">
                        Células
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
                                                <span class="userDatatable-title">Sector</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Célula</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Lider</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Anfitrión</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Tipo</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Estado</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title float-end">Acciones</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($cells) == 0)
                                            <tr>
                                                <td colspan="7">
                                                    <p class="text-center">Sin células</p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($cells as $cell)
                                                <tr>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $cell->sector->full_code }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $cell->code }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $cell->leader->full_name }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $cell->host->full_name ?? '' }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $cell->type }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span
                                                                class="bg-opacity-{{ $cell->status == 1 ? 'success' : 'warning' }}  color-{{ $cell->status == 1 ? 'success' : 'warning' }} rounded-pill userDatatable-content-status active">
                                                                {{ $cell->status == 1 ? 'Activo' : 'Inactivo' }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                            <li>
                                                                <a href="{{ route('cells.show', $cell->id) }}" class="view">
                                                                    <i class="uil uil-eye"></i>
                                                                </a>
                                                            </li>
                                                            @hasanyrole('Administrador|Supervisor|Pastor de Zona')
                                                            <li>
                                                                <a href="{{ route('cells.edit', $cell->id) }}" class="edit">
                                                                    <i class="uil uil-edit"></i>
                                                                </a>
                                                            </li>
                                                            @endhasanyrole
                                                            {{-- <li>
                                                                <a
                                                                    href="#"
                                                                    class="remove"
                                                                    onclick="
                                                                        event.preventDefault();
                                                                        if ( confirm('¿Desea eliminar la célula?') ) {
                                                                            document.getElementById( 'delete-{{ $cell->id }}' ).submit();
                                                                        }
                                                                    "
                                                                >
                                                                    <i class="uil uil-trash-alt"></i>
                                                                </a>

                                                                <form style="display:none;" id="delete-{{ $cell->id }}"
                                                                    action="{{ route('cells.destroy', $cell->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </li> --}}
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="pagination-container d-flex justify-content-end pt-25">
                        {{ $cells->links( 'pagination::bootstrap-5' ) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
