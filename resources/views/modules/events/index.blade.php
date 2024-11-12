@extends('layout.app')

@section('script')
<script>
    !function(t) {
    t("#external-events .fc-event").each((function() {
        t(this).data("event", {
            title: t.trim(t(this).text()),
            stick: !0
        }),
        t(this).draggable({
            zIndex: 999,
            revert: !0,
            revertDuration: 0
        })
    }
    ));
    new Date;
    let z = {
        id: 1,
        events: [
        @foreach ($z_events as $z_event)
            {
                id: {{ $z_event->id }},
                start: "{{ $z_event->start_date }}" + "T{{ $z_event->start_time }}",
                end: "{{ $z_event->end_date }}" + "T{{ $z_event->end_time }}",
                title: "{{ $z_event->name }}",
                place: "{{ $z_event->place }}",
                desc: "{{ $z_event->description }}",
                edit: "{{ route('events.edit', $z_event->id) }}"
            },
        @endforeach
        ],
        className: "success",
        textColor: "#20C997"
    }
      , d = {
        id: 2,
        events: [
        @foreach ($d_events as $d_event)
            {
                id: {{ $d_event->id }},
                start: "{{ $d_event->start_date }}" + "T{{ $d_event->start_time }}",
                end: "{{ $d_event->end_date }}" + "T{{ $d_event->end_time }}",
                title: "{{ $d_event->name }}",
                place: "{{ $d_event->place }}",
                desc: "{{ $d_event->description }}",
                edit: "{{ route('events.edit', $d_event->id) }}"
            },
        @endforeach
        ],
        className: "secondary",
        textColor: "#FF69A5"
    }
      , g = {
        id: 3,
        events: [
        @foreach ($g_events as $g_event)
            {
                id: {{ $g_event->id }},
                start: "{{ $g_event->start_date }}" + "T{{ $g_event->start_time }}",
                end: "{{ $g_event->end_date }}" + "T{{ $g_event->end_time }}",
                title: "{{ $g_event->name }}",
                place: "{{ $g_event->place }}",
                desc: "{{ $g_event->description }}",
                edit: "{{ route('events.edit', $g_event->id) }}"
            },
        @endforeach
        ],
        className: "primary",
        textColor: "#FFFFFF"
    }
    //   , i = {
    //     id: 4,
    //     events: [{
    //         id: "1",
    //         start: moment().format("YYYY-MM-25") + "T11:00:00",
    //         title: "Team Meeting"
    //     }, {
    //         id: "2",
    //         start: moment().format("YYYY-MM-DD") + "T07:00:00",
    //         end: moment().format("YYYY-MM-DD") + "T08:30:00",
    //         title: "HexaDash Calendar App"
    //     }],
    //     className: "warning",
    //     textColor: "#FA8B0C"
    // };
    document.addEventListener("DOMContentLoaded", (function() {
        var l = document.getElementById("full-calendar-event");
        moment.locale('es', {
            months : 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
            longDateFormat : {
                LLL : 'D MMMM YYYY - hh:mm a',
            },
        });
        if (l) {
            var o = new FullCalendar.Calendar(l,{
                locale: 'es',
                headerToolbar: {
                    left: "today,prev,title,next",
                    right: "timeGridDay,timeGridWeek,dayGridMonth,listMonth"
                },
                buttonText: {
                    today:    'hoy',
                    month:    'mes',
                    week:     'semana',
                    day:      'día',
                    list:     'Agenda'
                },
                slotLabelFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    omitZeroMinute: false,
                    hour12: true
                },
                views: {
                    listMonth: {
                        buttonText: "Listado",
                        titleFormat: {
                            month: "short",
                            weekday: "short"
                        }
                    }
                },
                listDayFormat: !0,
                // listDayAltFormat: !0,
                allDaySlot: !1,
                editable: !0,
                eventSources: [z, d, g],
                contentHeight: 800,
                initialView: "timeGridDay",
                eventDidMount: function(e) {
                    t(".fc-list-day").each((function() {}
                    ))
                },
                eventClick: function(e) {
                    let n = t("#e-info-modal");
                    n.modal("show"),
                    n.find(".e-info-title").text(e.event.title),
                    n.find(".e-info-date").text(moment(e.event.start).format('LLL')),
                    n.find(".e-info-place").text(e.event.extendedProps.place),
                    n.find(".e-info-desc").text(e.event.extendedProps.desc),
                    n.find(".url-edit").attr('href', e.event.extendedProps.edit)
                }
            });
            let r = document.getElementById("draggable-events");
            new FullCalendar.Draggable(r,{
                itemSelector: ".draggable-event-list__single",
                eventData: function(e) {
                    return {
                        title: e.innerText,
                        className: t(e).data("class")
                    }
                }
            });
            o.render(),
            t(".fc-button-group .fc-listMonth-button").prepend('<i class="las la-list"></i>')
        }
    }
    ))
}(jQuery);
</script>
@endsection

@section('content')
<div class="dm-page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Eventos</h4>
                </div>
            </div>
        </div>
        <div class="row calendar-grid justify-content-center">
            <div class="col-xxl-3 col-xl-5 col-md-6 col-sm-8">
                <div class="dm-calendar-left">
                    <a href="{{ route('events.create') }}" class="btn px-20 btn-primary btn-lg  btn-create-event">
                        <i class="las la-plus fs-16"></i>Crear Nuevo Evento
                    </a>
                    <div class="card card-md mb-4">
                        <div class="card-body px-10">
                            <div class="date-picker">
                                <div class="date-picker__calendar"></div>
                                <!-- ends: .date-picker__calendar -->
                            </div>
                        </div>
                    </div>
                    <div class="card card-md mb-4">
                        <div class="card-body">
                            <div class="draggable-events" id="draggable-events">
                                <div class="draggable-events__top d-flex justify-content-between">
                                    <h6>Próximos Eventos</h6>
                                    <a href="#">
                                        <img class="svg" src="{{ asset('assets/img/svg/plus.svg') }}" alt=""></a>
                                </div>
                                <ul class="draggable-event-list">
                                    <li>Zona</li>
                                    @foreach ($z_events as $z_event)
                                        <li class="draggable-event-list__single d-flex align-items-center" data-class="success">
                                            <span class="badge-dot badge-success"></span>
                                            <span class="event-text">{{ $z_event->name }}</span>
                                        </li>
                                    @endforeach
                                    <li>Distrito</li>
                                    @foreach ($d_events as $d_event)
                                        <li class="draggable-event-list__single d-flex align-items-center" data-class="secondary">
                                            <span class="badge-dot badge-secondary"></span>
                                            <span class="event-text">{{ $d_event->name }}</span>
                                        </li>
                                    @endforeach
                                    <li>General</li>
                                    @foreach ($g_events as $g_event)
                                        <li class="draggable-event-list__single d-flex align-items-center" data-class="primary">
                                            <span class="badge-dot badge-primary"></span>
                                            <span class="event-text">{{ $g_event->name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- ends: .card -->
                </div>
            </div>
            <!-- ends: .col-lg-3 -->
            <div class="col-xxl-9 col-xl-7">
                <div class="card card-default card-md mb-4">
                    <div class="card-body">
                        <div id='full-calendar-event'></div>
                    </div>
                </div>
                <!-- ends: .card -->
            </div>
        </div>
    </div>
</div>
<!-- ends: .dm-page-content -->

<div class="c-event-modal modal fade" id="c-event-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Crear Evento</h6>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg"></button>
            </div>
            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data"
            class="">
            @csrf
                <div class="modal-body">
                    <div class="c-event-form">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ends: .c-event-modal -->

<div class="e-info-modal modal fade" id="e-info-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm e-info-dialog modal-dialog-centered" id="c-event" role="document">
        <div class="modal-content">
            <div class="modal-header e-info-header bg-primary">
                <h6 class="modal-title e-info-title">Evento</h6>
                <div class="e-info-action">
                    <a href="#" class="btn-icon url-edit">
                        <img class="svg" src="{{ asset('assets/img/svg/edit.svg') }}" alt="edit">
                    </a>
                    {{-- <button class="btn-icon">
                        <img class="svg" src="{{ asset('assets/img/svg/mail.svg') }}" alt="mail">
                    </button> --}}
                    {{-- <a href="#" class="btn-icon url-delete">
                        <img class="svg" src="{{ asset('assets/img/svg/trash-2.svg') }}" alt="trash">
                    </a> --}}
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
