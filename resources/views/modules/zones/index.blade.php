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
                                <a href="{{ route('zones.create') }}" class="btn px-20 btn-primary ">
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
                        Zonas
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
                                                <span class="userDatatable-title">Distrito</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Zona</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Pastor</span>
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
                                        @if (count($zones) == 0)
                                            <tr>
                                                <td colspan="7">
                                                    <p class="text-center">Sin zonas</p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($zones as $zone)
                                                <tr>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $zone->district->code }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="userDatatable-inline-title">
                                                                <span>
                                                                    <a href="{{ route('sectors.search', $zone->id) }}"
                                                                        class="link">{{ $zone->code }}</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $zone->user->member->full_name }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span
                                                                class="bg-opacity-{{ $zone->status == 1 ? 'success' : 'warning' }}  color-{{ $zone->status == 1 ? 'success' : 'warning' }} rounded-pill userDatatable-content-status active">
                                                                {{ $zone->status == 1 ? 'Activo' : 'Inactivo' }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    @hasrole('Admin')
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                            <li>
                                                                <a href="{{ route('zones.edit', $zone->id) }}"
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
                                                                        if ( confirm('¿Desea eliminar la zona?') ) {
                                                                            document.getElementById( 'delete-{{ $zone->id }}' ).submit();
                                                                        }
                                                                    "
                                                                >
                                                                    <i class="uil uil-trash-alt"></i>
                                                                </a>

                                                                <form style="display:none;" id="delete-{{ $zone->id }}"
                                                                    action="{{ route('zones.destroy', $zone->id) }}"
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
                            {{ $zones->links( 'pagination::bootstrap-5' ) }}

                            <ul class="dm-pagination d-flex">
                                <li class="dm-pagination__item">
                                    <div class="paging-option">
                                        <select name="page-number" class="page-selection" onchange="updatePagination( event )">
                                            <option value="10" {{ 10 == $zones->perPage() ? 'selected' : '' }}>10/página</option>
                                            <option value="20" {{ 20 == $zones->perPage() ? 'selected' : '' }}>20/página</option>
                                            <option value="50" {{ 50 == $zones->perPage() ? 'selected' : '' }}>50/página</option>
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
