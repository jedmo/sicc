@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-breadcrumb">
                    <div class="breadcrumb-main add-contact justify-content-sm-between ">
                        <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="action-btn mt-sm-0 mt-15">
                                <a href="{{ route('roles.create') }}" class="btn px-20 btn-primary ">
                                    <i class="las la-plus fs-16"></i>Agregar nuevo
                                </a>
                            </div>
                        </div>
                        <div class="breadcrumb-main__wrapper">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-body">
                        <div class="userDatatable global-shadow border-light-0 w-100">
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless">
                                    <thead>
                                        <tr class="userDatatable-header">
                                            <th>
                                                <span class="checkbox-text userDatatable-title">Nombre</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title float-end">Acciones</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($roles) == 0)
                                            <tr>
                                                <td colspan="7">
                                                    <p class="text-center">Sin roles</p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($roles as $role)
                                                <tr>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $role->name }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                            <li>
                                                                <a href="{{ route('roles.show', $role->id) }}"
                                                                    class="view">
                                                                    <i class="uil uil-eye"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('roles.edit', $role->id) }}"
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
                                                                        if ( confirm('¿Esta seguro de desear eliminar el usuario?') ) {
                                                                            document.getElementById( 'delete-{{ $role->id }}' ).submit();
                                                                        }
                                                                    "
                                                                >
                                                                    <i class="uil uil-trash-alt"></i>
                                                                </a>

                                                                <form style="display:none;" id="delete-{{ $role->id }}"
                                                                    action="{{ route('roles.destroy', $role->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination-container d-flex justify-content-end pt-25">
                            {{ $roles->links( 'pagination::bootstrap-5' ) }}

                            <ul class="dm-pagination d-flex">
                                <li class="dm-pagination__item">
                                    <div class="paging-option">
                                        <select name="page-number" class="page-selection" onchange="updatePagination( event )">
                                            <option value="20" {{ 20 == $roles->perPage() ? 'selected' : '' }}>20/página</option>
                                            <option value="40" {{ 40 == $roles->perPage() ? 'selected' : '' }}>40/página</option>
                                            <option value="60" {{ 60 == $roles->perPage() ? 'selected' : '' }}>60/página</option>
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
