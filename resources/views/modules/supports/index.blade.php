@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">Atención a Incidencias</h4>
                </div>
            </div>
        </div>
        <div class="banner-feature--14 card mb-25">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="card-body d-inline-block">
                                <h1 class="d-flex">Hola, estamos aquí para ayudar</h1>
                                <p>Comentarios sobre el sector o la zona, inconvenientes con la célula o sugerencias
                                </p>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('supports.create') }}" class="btn btn-primary btn-default btn-squared btn-shadow-primary">
                                        Crear un ticket de atención
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="banner-feature__shape mt-50 d-flex justify-content-end">
                                <img src="{{ asset('assets/img/svg/banne-group21.svg') }}" alt="img" class="svg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-11">
                    @if(count($supports) > 0)
                    <div class="userDatatable userDatatable--ticket my-4">
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless">
                                <thead>
                                    <tr class="userDatatable-header">
                                        <th>
                                            <span class="userDatatable-title">ID</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Asunto</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Estado</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Fecha de creación</span>
                                        </th>
                                        <th class="actions">
                                            <span class="userDatatable-title">Acciones</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supports as $support)
                                    <tr>
                                        <td>#{{ $support->id }}</td>
                                        <td>
                                            <div class="userDatatable-content--subject">
                                                {{ $support->subject }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content d-inline-block">
                                                <span class="bg-opacity-{{ $support->status == 1 ? 'success' : (($support->status == 2) ? 'warning' : 'danger') }}
                                                    color-{{ $support->status == 1 ? 'success' : (($support->status == 2) ? 'warning' : 'danger') }} userDatatable-content-status active">
                                                    {{ $support->status == 1 ? 'Pendiente' : (($support->status == 2) ? 'Revisando' : 'Cerrado') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content--date">
                                                {{ $support->created_at }}
                                            </div>
                                        </td>
                                        <td>
                                            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                <li>
                                                    <a href="#" class="edit">
                                                        <i class="uil uil-edit"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="remove">
                                                        <i class="uil uil-trash-alt"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card banner-feature--16 mb-50  px-xxl-0 px-sm-30 px-15">
            <div class="row justify-content-center">
                <div class="col-xxl-9">
                    <div class="row">
                        <div class="col-xxl-4 col-lg-6 mb-25">
                            <div class="card shadow-none border-0">
                                <div class="card-body banner-feature--15">
                                    <div class="banner-feature__shape d-flex justify-content-center">
                                        <div class="wh-80 bg-primary rounded-circle content-center">
                                            <img src="{{ asset('assets/img/svg/idea.svg') }}" alt="img" class="svg">
                                        </div>
                                    </div>
                                    <div class="pb-md-0 pb-30 text-center">
                                        <h4>Sistema celular</h4>
                                        <p>Programa de las células, círculos de influencia, como hacer un invitado, etc.</p>
                                    </div>
                                    <div class="content-center mt-25">
                                        <button class="btn btn-primary btn-sm btn-squared btn-transparent-primary rounded-pill">Leer
                                            Más</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-lg-6 mb-25">
                            <div class="card shadow-none border-0">
                                <div class="card-body banner-feature--15">
                                    <div class="banner-feature__shape d-flex justify-content-center">
                                        <div class="wh-80 bg-info rounded-circle content-center">
                                            <img src="{{ asset('assets/img/svg/chat.svg') }}" alt="img" class="svg">
                                        </div>
                                    </div>
                                    <div class="pb-md-0 pb-30 text-center">
                                        <h4>Preguntas Frecuentes</h4>
                                        <p>Movilizacón célular, cultos y actividades</p>
                                    </div>
                                    <div class="content-center mt-25">
                                        <button class="btn btn-primary btn-sm btn-squared btn-transparent-primary rounded-pill">Leer
                                            Más</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-lg-6 mb-25">
                            <div class="card shadow-none border-0">
                                <div class="card-body banner-feature--15">
                                    <div class="banner-feature__shape d-flex justify-content-center">
                                        <div class="wh-80 bg-success rounded-circle content-center">
                                            <img src="{{ asset('assets/img/svg/documents.svg') }}" alt="img" class="svg">
                                        </div>
                                    </div>
                                    <div class="pb-md-0 pb-30 text-center">
                                        <h4>Documentación</h4>
                                        <p>Tutoriales del uso del sistema, características y funciones.</p>
                                    </div>
                                    <div class="content-center mt-25">
                                        <button class="btn btn-primary btn-sm btn-squared btn-transparent-primary rounded-pill">Leer
                                            Más</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-feature--17 px-xxl-0 px-sm-30 px-0">
                <div class="row justify-content-center">
                    <div class="col-xxl-9">
                        <div class="card pb-0 mb-md-50 mb-30 border">
                            <div class="card-header px-30 pt-30 pb-25 border-bottom-0">
                                <h4 class="fw-500">Preguntás Frecuentes</h4>
                            </div>
                            <div class="card-body pt-0 pb-30 px-md-30 px-15">
                                <div class="application-faqs">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        How long does it take to download updates?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Many support queries and technical questions will
                                                        already be answered in supporting documentation such as FAQ's
                                                        and comments from previous buyers. Anim pariatur cliche
                                                        reprehenderit, enim eiusmod high life accusamus terry richardson
                                                        ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                        dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch
                                                        3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et.</p>
                                                    <span class="fs-14 fw-500 color-dark">Was this article
                                                        helpful?</span>
                                                    <div class="button-group d-flex mt-2 flex-wrap">
                                                        <button class="btn btn-default btn-squared btn-outline-success px-15 ">
                                                            <img src="{{ asset('assets/img/svg/meh.svg') }}" alt="meh" class="svg">
                                                            Yes
                                                        </button>
                                                        <button class="btn btn-default btn-squared btn-outline-warning px-15 "><img src="{{ asset('assets/img/svg/frown.svg') }}" alt="frown" class="svg">
                                                            No
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingTwo">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        How to use SCSS variables to build custom color?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse" data-parent="#accordion" role="tabpanel" aria-labelledby="headingTwo">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Many support queries and technical questions will
                                                        already be answered in supporting documentation such as FAQ's
                                                        and comments from previous buyers. Anim pariatur cliche
                                                        reprehenderit, enim eiusmod high life accusamus terry richardson
                                                        ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                        dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch
                                                        3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et.</p>
                                                    <span class="fs-14 fw-500 color-dark">Was this article
                                                        helpful?</span>
                                                    <div class="button-group d-flex mt-2 flex-wrap">
                                                        <button class="btn btn-default btn-squared btn-outline-success px-15 "><img src="{{ asset('assets/img/svg/meh.svg') }}" alt="meh" class="svg">
                                                            Yes
                                                        </button>
                                                        <button class="btn btn-default btn-squared btn-outline-warning px-15 "><img src="{{ asset('assets/img/svg/frown.svg') }}" alt="frown" class="svg">
                                                            No
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingThree">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-bs-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        How long does it take to download updates?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Many support queries and technical questions will
                                                        already be answered in supporting documentation such as FAQ's
                                                        and comments from previous buyers. Anim pariatur cliche
                                                        reprehenderit, enim eiusmod high life accusamus terry richardson
                                                        ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                        dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch
                                                        3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et.</p>
                                                    <span class="fs-14 fw-500 color-dark">Was this article
                                                        helpful?</span>
                                                    <div class="button-group d-flex mt-2 flex-wrap">
                                                        <button class="btn btn-default btn-squared btn-outline-success px-15 "><img src="{{ asset('assets/img/svg/meh.svg') }}" alt="meh" class="svg">
                                                            Yes
                                                        </button>
                                                        <button class="btn btn-default btn-squared btn-outline-warning px-15 ">
                                                            <img src="{{ asset('assets/img/svg/frown.svg') }}" alt="frown" class="svg">
                                                            No
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingfour">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-bs-toggle="collapse" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                                        What is the flex layout?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour" data-parent="#accordion">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Many support queries and technical questions will
                                                        already be answered in supporting documentation such as FAQ's
                                                        and comments from previous buyers. Anim pariatur cliche
                                                        reprehenderit, enim eiusmod high life accusamus terry richardson
                                                        ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                        dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch
                                                        3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et.</p>
                                                    <span class="fs-14 fw-500 color-dark">Was this article
                                                        helpful?</span>
                                                    <div class="button-group d-flex mt-2 flex-wrap">
                                                        <button class="btn btn-default btn-squared btn-outline-success px-15 "><img src="{{ asset('assets/img/svg/meh.svg') }}" alt="meh" class="svg">
                                                            Yes
                                                        </button>
                                                        <button class="btn btn-default btn-squared btn-outline-warning px-15 "><img src="{{ asset('assets/img/svg/frown.svg') }}" alt="frown" class="svg">
                                                            No
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingfive">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-bs-toggle="collapse" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                                        How long does it take to download updates?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfive" data-parent="#accordion">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Many support queries and technical questions will
                                                        already be answered in supporting documentation such as FAQ's
                                                        and comments from previous buyers. Anim pariatur cliche
                                                        reprehenderit, enim eiusmod high life accusamus terry richardson
                                                        ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                        dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch
                                                        3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et.</p>
                                                    <span class="fs-14 fw-500 color-dark">Was this article
                                                        helpful?</span>
                                                    <div class="button-group d-flex mt-2 flex-wrap">
                                                        <button class="btn btn-default btn-squared btn-outline-success px-15 "><img src="{{ asset('assets/img/svg/meh.svg') }}" alt="meh" class="svg">
                                                            Yes
                                                        </button>
                                                        <button class="btn btn-default btn-squared btn-outline-warning px-15 "><img src="{{ asset('assets/img/svg/frown.svg') }}" alt="frown" class="svg">
                                                            No
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingsix">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-bs-toggle="collapse" href="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                                                        Where to buy this UI dashboard?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingsix" data-parent="#accordion">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Many support queries and technical questions will
                                                        already be answered in supporting documentation such as FAQ's
                                                        and comments from previous buyers. Anim pariatur cliche
                                                        reprehenderit, enim eiusmod high life accusamus terry richardson
                                                        ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                        dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch
                                                        3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et.</p>
                                                    <span class="fs-14 fw-500 color-dark">Was this article
                                                        helpful?</span>
                                                    <div class="button-group d-flex mt-2 flex-wrap">
                                                        <button class="btn btn-default btn-squared btn-outline-success px-15 "><img src="{{ asset('assets/img/svg/meh.svg') }}" alt="meh" class="svg">
                                                            Yes
                                                        </button>
                                                        <button class="btn btn-default btn-squared btn-outline-warning px-15 "><img src="{{ asset('assets/img/svg/frown.svg') }}" alt="frown" class="svg">
                                                            No
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingseven">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-bs-toggle="collapse" href="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
                                                        How long does it take to download updates?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseseven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingseven" data-parent="#accordion">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Many support queries and technical questions will
                                                        already be answered in supporting documentation such as FAQ's
                                                        and comments from previous buyers. Anim pariatur cliche
                                                        reprehenderit, enim eiusmod high life accusamus terry richardson
                                                        ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                        dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch
                                                        3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et.</p>
                                                    <span class="fs-14 fw-500 color-dark">Was this article
                                                        helpful?</span>
                                                    <div class="button-group d-flex mt-2 flex-wrap">
                                                        <button class="btn btn-default btn-squared btn-outline-success px-15 "><img src="{{ asset('assets/img/svg/meh.svg') }}" alt="meh" class="svg">
                                                            Yes
                                                        </button>
                                                        <button class="btn btn-default btn-squared btn-outline-warning px-15 "><img src="{{ asset('assets/img/svg/frown.svg') }}" alt="frown" class="svg">
                                                            No
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
