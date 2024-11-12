@extends('layout.app')
@section('content')

<div class="new-ticket mt-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">{{ trans('page_title.new_ticket') }}</h4>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-50 mt-25">
            <div class="col-sm-6">
                <div class="ticket_modal">
                    <div class="ticket_modal-modal">
                        <h1>
                            Envíe su Ticket
                        </h1>
                        <form action="{{ route('supports.store') }}" method="POST" enctype="multipart/form-data"
                            class="was-validated">
                            @csrf
                            <div class="form-group">
                                <label>Asunto</label>
                                <input type="text" class="form-control" name="subject" required>
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea class="form-control" rows="3" name="description" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Numero de contacto (si desea ser contactado)</label>
                                <input type="text" class="form-control" name="contact">
                            </div>
                            <div class="button-group d-flex pt-15">
                                <button class="btn btn-primary btn-default btn-squared ">Enviar ticket</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
