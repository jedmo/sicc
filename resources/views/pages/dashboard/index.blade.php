@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('script')
<script type="text/javascript">

    moment.locale('es', {
        months : 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
        longDateFormat : {
            LLL : 'D MMMM YYYY - hh:mm a',
        },
    });
    $(window).on('load', function() {
        if ({{ $q }} <= 10) {
            let m = $("#modal-event");
            m.modal("show"),
            m.find(".e-info-title").text('{{ $n_event->name }}'),
            m.find(".e-info-date").text(moment('{{ $n_event->start_date ." ". $n_event->start_time }}').format('LLL')),
            m.find(".e-info-place").text('{{ $n_event->place }}'),
            m.find(".e-info-desc").text('{{ $n_event->description }}')
        }
    });
</script>
@endsection
@section('content')
<div class="demo2 mb-25 t-thead-bg">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">{{ trans('page_title.home') }}</h4>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Resumen</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            @include('components.index.overview_cards')
            @include('components.index.cell_meeting_graph')
            @include('components.index.attendance_percentage')
            @include('components.index.upcoming_events')
            @include('components.index.cell_member')
        </div>
    </div>
</div>
<div class="e-info-modal modal fade" id="modal-event" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm e-info-dialog modal-dialog-centered" id="c-event" role="document">
        <div class="modal-content">
            <div class="modal-header e-info-header bg-primary">
                <h6 class="modal-title e-info-title">Evento</h6>
                <div class="e-info-action">
                    <button type="button" class="btn-icon btn-closed" data-bs-dismiss="modal" aria-label="Close">
                        <i class="uil uil-times"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <ul class="e-info-list">
                    <li>
                        <img class="svg" src="{{ asset('assets/img/svg/calendar.svg') }}" alt="calendar">
                        <span class="list-line">
                            <span class="list-label">Fecha :</span>
                            <span class="list-meta e-info-date"> Próximo</span>
                        </span>
                    </li>
                    <li>
                        <img class="svg" src="{{ asset('assets/img/svg/map-pin.svg') }}" alt="map-pin">
                        <span class="list-line">
                            <span class="list-label">Lugar :</span>
                            <span class="list-meta e-info-place"> Iglesia</span>
                        </span>
                    </li>
                    <li>
                        <img class="svg" src="{{ asset('assets/img/svg/align-left.svg') }}" alt="align-left">
                        <span class="list-line">
                            <span class="list-text e-info-desc"> Lorem ipsum dolor sit amet consetetur sadipscing elitr sed diam consetetur sadipscing elitr sed diam</span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
