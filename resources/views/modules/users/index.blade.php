@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-breadcrumb">
                    <div class="breadcrumb-main add-contact justify-content-sm-between ">
                        <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="action-btn mt-sm-0 mt-15">
                                <a href="{{ route('users.create') }}" class="btn px-20 btn-primary ">
                                    <i class="las la-plus fs-16"></i>Agregar nuevo
                                </a>
                            </div>
                        </div>
                        <div class="breadcrumb-main__wrapper">

                            <form action="{{ route('users.index') }}" class="d-flex align-items-center add-contact__form my-sm-0 my-2">
                                <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                <input class="form-control me-sm-2 border-0 box-shadow-none" type="search"
                                    placeholder="Buscar por nombre" aria-label="Search" name="search" value="{{ $search_by }}">
                                    <button class="btn px-10 btn-primary" type="submit">Filtrar</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-header color-dark fw-500">
                        Customer List
                    </div>
                    <div class="card-body">
                        <div class="userDatatable global-shadow border-light-0 w-100">
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless">
                                    <thead>
                                        <tr class="userDatatable-header">
                                            <th>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-checkbox  check-all">
                                                        <input class="checkbox" type="checkbox" id="check-45">
                                                        <label for="check-45">
                                                            <span class="checkbox-text userDatatable-title">Nombre</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Usuario</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Correo</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Teléfono</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Rol</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Sexo</span>
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
                                        @if (count($users) == 0)
                                            <tr>
                                                <td colspan="7">
                                                    <p class="text-center">Sin usuarios</p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($users as $user)
                                                @php
                                                    $has_profile_picture = ! empty( $user->profile_picture );
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div
                                                                class="userDatatable__imgWrapper d-flex align-items-center">
                                                                <div class="checkbox-group-wrapper">
                                                                    <div class="checkbox-group d-flex">
                                                                        <div
                                                                            class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                                                            <input class="checkbox" type="checkbox" id="check-{{ $user->id }}">
                                                                            <label for="check-{{ $user->id }}"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <a href="#" class="profile-image rounded-circle d-block m-0 wh-38" style="background-image:url('{{ $has_profile_picture ? Helper::get_public_storage_asset_url( $user->profile_picture ) : asset( 'assets/img/svg/user.svg' ) }}'); background-size: cover;"></a>
                                                            </div>
                                                            <div class="userDatatable-inline-title">
                                                                <a href="#" class="text-dark fw-500">
                                                                    <h6>{{ $user->name }}</h6>
                                                                </a>
                                                                <p class="d-block mb-0">
                                                                    {{ $user->address == null ? '' : $user->address }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="">
                                                            {{ $user->user }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="">
                                                            {{ $user->email }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content">
                                                            {{ $user->phone }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content">
                                                            @if (!empty($user->getRoleNames()))
                                                                @foreach ($user->getRoleNames() as $rol)
                                                                    {{ $rol }}
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content">
                                                            {{ $user->sex }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span
                                                                class="bg-opacity-{{ $user->status == 1 ? 'success' : 'warning' }}  color-{{ $user->status == 1 ? 'success' : 'warning' }} rounded-pill userDatatable-content-status active">
                                                                {{ $user->status == 1 ? 'Activo' : 'Inactivo' }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                            <li>
                                                                <a href="{{ route('users.show', $user->id) }}"
                                                                    class="view">
                                                                    <i class="uil uil-eye"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('users.edit', $user->id) }}"
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
                                                                            document.getElementById( 'delete-{{ $user->id }}' ).submit();
                                                                        }
                                                                    "
                                                                >
                                                                    <i class="uil uil-trash-alt"></i>
                                                                </a>

                                                                <form style="display:none;" id="delete-{{ $user->id }}"
                                                                    action="{{ route('users.destroy', $user->id) }}"
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
                            {{ $users->links( 'pagination::bootstrap-5' ) }}

                            <ul class="dm-pagination d-flex">
                                <li class="dm-pagination__item">
                                    <div class="paging-option">
                                        <select name="page-number" class="page-selection" onchange="updatePagination( event )">
                                            <option value="20" {{ 20 == $users->perPage() ? 'selected' : '' }}>20/página</option>
                                            <option value="40" {{ 40 == $users->perPage() ? 'selected' : '' }}>40/página</option>
                                            <option value="60" {{ 60 == $users->perPage() ? 'selected' : '' }}>60/página</option>
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
