@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex align-items-center user-member__title mb-30 mt-30">
                <h4 class="text-capitalize">Agregar asistencia al templo</h4>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class=" alert alert-success " role="alert">
        <div class="alert-content">
            {{ session('status') }}
        </div>
    </div>
    @endif
    <div class="card mb-50">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-10">
                    <div class="mt-40 mb-50">
                        <form action="{{ route('church-attendances.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="edit-profile__body">
                                @if ($role == 'Líder')
                                <div class="form-group row mb-25">
                                    <div class="col-12">
                                        <h6>CÉLULA {{ $cells->full_code }}</h6>
                                        <input type="hidden" name="cell_id" value="{{ $cells->id }}" />
                                    </div>
                                </div>
                                @elseif ($role == 'Supervisor')
                                <div class="form-group row mb-25">
                                    <div class="col-12">
                                        <h6>SECTOR {{ $sector->full_code }}</h6>
                                    </div>
                                    <div class="col-3">
                                        <label for="select-cell"
                                            class="il-gray fs-14 fw-500 align-center mb-10">Célula</label>
                                        <select name="cell_id" id="select-cell" class="form-control ">
                                            <option value="">Seleccione una célula</option>
                                            @forelse ($cells as $cell)
                                            <option value="{{ $cell->id }}">{{ $cell->code }}</option>
                                            @empty
                                            <option value="">Sin célula</option>
                                            @endforelse
                                        </select>
                                        @if ($errors->has('cell_id'))
                                        <p class="text-danger">{{ $errors->first('cell_id') }}</p>
                                        @endif
                                    </div>
                                </div>
                                @else
                                @endif
                                @include('modules.church_attendances.form')
                                <div class="button-group d-flex pt-25 justify-content-md-end justify-content-start">
                                    <a href="{{ route('church-attendances.index') }}"
                                        class="btn btn-light btn-default btn-squared fw-400 text-capitalize m-sm-0 m-1">Cancelar</a>
                                    <button type="submit"
                                        class="btn btn-primary btn-default btn-squared radius-md shadow2 btn-sm">Guardar</button>
                                </div>
                            </div>
                        </form>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            {{ $error }}
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
