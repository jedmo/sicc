@extends('layout.app')
@section('content')
    <div class="container-fluid">
        @hasrole('Admin')
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-breadcrumb">
                    <div class="breadcrumb-main add-contact justify-content-sm-between ">
                        <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="action-btn mt-sm-0 mt-15">
                                <a href="{{ route('sectors.create') }}" class="btn px-20 btn-primary ">
                                    <i class="las la-plus fs-16"></i>Agregar nuevo
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
                        Sectores 
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
                                                <span class="userDatatable-title">Supervisor</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Estado</span>
                                            </th>
                                            @hasrole('Admin')
                                            <th>
                                                <span class="userDatatable-title float-end">Acciones</span>
                                            </th>
                                            @endhasrole
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($sectors) == 0)
                                            <tr>
                                                <td colspan="7">
                                                    <p class="text-center">Sin sectores</p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($sectors as $sector)
                                                <tr>
                                                    <td>
                                                        <div class="userDatatable-inline-title">
                                                            <span>
                                                                <a href="{{ route('cells.search', $sector->id) }}"
                                                                    class="link">{{ $sector->full_code }}</a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $sector->member->full_name ?? null }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span
                                                                class="bg-opacity-{{ $sector->status == 1 ? 'success' : 'warning' }}  color-{{ $sector->status == 1 ? 'success' : 'warning' }} rounded-pill userDatatable-content-status active">
                                                                {{ $sector->status == 1 ? 'Activo' : 'Inactivo' }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    @hasrole('Administrador')
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                            <li>
                                                                <a href="{{ route('sectors.edit', $sector->id) }}"
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
                                                                        if ( confirm('¿Desea eliminar el sector?') ) {
                                                                            document.getElementById( 'delete-{{ $sector->id }}' ).submit();
                                                                        }
                                                                    "
                                                                >
                                                                    <i class="uil uil-trash-alt"></i>
                                                                </a>

                                                                <form style="display:none;" id="delete-{{ $sector->id }}"
                                                                    action="{{ route('sectors.destroy', $sector->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    @endhasrole
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination-container d-flex justify-content-end pt-25">
                            {{ $sectors->links( 'pagination::bootstrap-5' ) }}

                            <ul class="dm-pagination d-flex">
                                <li class="dm-pagination__item">
                                    <div class="paging-option">
                                        <select name="page-number" class="page-selection" onchange="updatePagination( event )">
                                            <option value="10" {{ 10 == $sectors->perPage() ? 'selected' : '' }}>10/página</option>
                                            <option value="20" {{ 20 == $sectors->perPage() ? 'selected' : '' }}>20/página</option>
                                            <option value="50" {{ 50 == $sectors->perPage() ? 'selected' : '' }}>50/página</option>
                                        </select>
                                        <a href="/pagination-per-page/20" class="d-none per-page-pagination"></a>
                                    </div>
                                </li>
                            </ul>

                            <script>
                                function updatePagination( event ) {
                                    var per_page = event.target.value;

                                    const per_page_link = document.querySelector( '.per-page-pagination' );
                                    per_page_link.setAttribute( 'href', '/pagination-per-page/' + per_page  );

                                    per_page_link.click();
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
