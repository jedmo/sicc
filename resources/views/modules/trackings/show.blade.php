@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-header color-dark fw-500">
                        Proceso
                    </div>
                    <div class="card-body">
                        <div class="userDatatable global-shadow border-light-0 w-100">
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless">
                                    <thead>
                                        <tr class="userDatatable-header">
                                            <th>
                                                <span class="userDatatable-title">Proceso</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Fecha</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Lugar</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Comentario</span>
                                            </th>
                                            @hasrole('Admin')
                                            <th>
                                                <span class="userDatatable-title float-end">Acciones</span>
                                            </th>
                                            @endhasrole
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($trackings) == 0)
                                            <tr>
                                                <td colspan="7">
                                                    <p class="text-center">Sin procesos</p>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($trackings as $tracking)
                                                <tr>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $tracking->step }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $tracking->step_date }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $tracking->location }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="userDatatable-content d-inline-block">
                                                            <span>{{ $tracking->comment }}</span>
                                                        </div>
                                                    </td>
                                                    @hasrole('Admin')
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                            <li>
                                                                <a href="{{ route('trackings.edit', $tracking->id) }}"
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
                                                                        if ( confirm('¿Desea remover el proceso?') ) {
                                                                            document.getElementById( 'delete-{{ $tracking->id }}' ).submit();
                                                                        }
                                                                    "
                                                                >
                                                                    <i class="uil uil-trash-alt"></i>
                                                                </a>

                                                                <form style="display:none;" id="delete-{{ $tracking->id }}"
                                                                    action="{{ route('trackings.destroy', [$tracking->id, $member_id]) }}"
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
                            <div class="button-group d-flex pt-25 justify-content-md-end justify-content-start">
                                <a href="{{ route('members.index') }}"
                                    class="btn btn-light btn-default btn-squared fw-400 text-capitalize m-sm-0 m-1">Atras</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
