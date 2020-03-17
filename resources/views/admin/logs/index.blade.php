@extends('layouts.admin.layout')


@section('content')
    <div class="main-panel" style="width: 100% !important;">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    ALl Logs
                </h3>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recent Activities</h4>
                            <div class="mt-5">
                                <div class="timeline">

                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($logs as $log)
                                        <div class="timeline-wrapper {{ $i % 2 == 0 ? 'timeline-inverted timeline-wrapper-warning' : 'timeline-wrapper-success' }} ">
                                            <div class="timeline-badge"></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h6 class="timeline-title"><b>{{$log->title}}</b></h6>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>
                                                        {{$log->body}}
                                                    </p>
                                                </div>
                                                <div class="timeline-footer d-flex align-items-center">
                                                    <span class="ml-auto font-weight-bold">{{ $log->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection