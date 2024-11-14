@extends('layout.app')
@section('content')
    <div class="container-fluid">
        @hasrole(['Administrador|Supervisor|Líder'])
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-breadcrumb">
                    <div class="breadcrumb-main add-contact justify-content-sm-between ">
                        <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="action-btn mt-sm-0 mt-15">
                                <a href="{{ route('members.create') }}" class="btn px-20 btn-primary ">
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
                        Miembros de célula
                    </div>
                    <div class="card-body">
                        @hasrole('Supervisor')
                        <form method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="cell_id" id="cell_id">
                                        <option value="">Seleccione</option>
                                        @foreach ( $cells as $cell )
                                            <option value="{{ $cell['id'] }}" {{ $cell_id == $cell['id'] ? 'selected' : '' }}>
                                                Célula - {{ $cell['code'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 dm-button-list d-flex flex-wrap">
                                    <div class="action-btn mt-sm-0 mt-15">
                                        <button class="btn btn-secondary btn-default btn-rounded" type="submit">
                                            <i class="las la-search fs-16"></i>Filtrar
                                        </button>
                                    </div>
                                    @if ($cell_id)
                                        <div class="action-btn mt-sm-0 mt-15">
                                            <a href="{{ route('members.index') }}" class="btn btn-info btn-default btn-rounded" style="margin: 5px 6px">
                                                Quitar filtro
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                        @endhasrole
                        @if ($message = Session::get('success'))
                            <div class=" alert alert-success " role="alert">
                                <div class="alert-content">
                                    <p>{{ $message }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class=" alert alert-danger " role="alert">
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
                                            <th>
                                                <span class="userDatatable-title">Sexo</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Estado</span>
                                            </th>
                                            {{-- @hasanyrole('Administrador|Supervisor|Líder') --}}
                                            <th>
                                                <span class="userDatatable-title float-end">Acciones</span>
                                            </th>
                                            {{-- @endhasanyrole --}}
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
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $member->member->sex }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span
                                                                class="bg-opacity-{{ $member->member->status == 1 ? 'success' : 'warning' }}  color-{{ $member->member->status == 1 ? 'success' : 'warning' }} rounded-pill memberDatatable-content-status active">
                                                                {{ $member->member->status == 1 ? 'Activo' : 'Inactivo' }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    {{-- @hasanyrole('Administrador|Supervisor|Líder') --}}
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                            <li>
                                                                <a href="{{ route('trackings.show', $member->member_id) }}" class="view">
                                                                    <i class="uil uil-eye"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('trackings.create', $member->member_id) }}"
                                                                    class="edit">
                                                                    <i class="uil uil-folder-plus"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('members.edit', $member->member_id) }}"
                                                                    class="edit">
                                                                    <i class="uil uil-edit"></i>
                                                                </a>
                                                            </li>
                                                            @unlessrole('Líder')
                                                            <li>
                                                                <a
                                                                    href="#"
                                                                    class="remove"
                                                                    onclick="
                                                                        event.preventDefault();
                                                                        if ( confirm('¿Desea remover el miembro?') ) {
                                                                            document.getElementById( 'delete-{{ $member->member_id }}' ).submit();
                                                                        }
                                                                    "
                                                                >
                                                                    <i class="uil uil-trash-alt"></i>
                                                                </a>

                                                                <form style="display:none;" id="delete-{{ $member->member_id }}"
                                                                    action="{{ route('members.destroy', $member->member_id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </li>
                                                            @endunlessrole
                                                        </ul>
                                                    </td>
                                                    {{-- @endhasanyrole --}}
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination-container d-flex justify-content-end pt-25">
                            {{ $members->links( 'pagination::bootstrap-5' ) }}

                            <ul class="dm-pagination d-flex">
                                <li class="dm-pagination__item">
                                    <div class="paging-option">
                                        <select name="page-number" class="page-selection" onchange="updatePagination( event )">
                                            <option value="10" {{ 10 == $members->perPage() ? 'selected' : '' }}>10/página</option>
                                            <option value="20" {{ 20 == $members->perPage() ? 'selected' : '' }}>20/página</option>
                                            <option value="50" {{ 50 == $members->perPage() ? 'selected' : '' }}>50/página</option>
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
