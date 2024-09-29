@section('title',$title)
@section('description',$description)
@extends('layout.app')
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
                                <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>{{ trans('page_title.home') }}</a></li>
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
@endsection
