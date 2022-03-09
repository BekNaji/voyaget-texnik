@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .border-bottom-dotted {
            border-bottom: 1px dotted #ccc;
        }

        .gosNumber {
            border: 8px solid;
            display: flex;
            padding: 0px 10px;
            font-size: 87px;
            border-radius: 10px;
            justify-content: space-between;
            width: 100%;
            font-weight: 500;
            color: black;
            background: white;
        }

        .gosNumber span {
            padding: 0px 10px;

        }

        .gosNumber span.code {
            border-right: 2px solid rgb(0, 0, 0);
        }

    </style>
@stop

@section('page_title', 'Show Application')

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-file-text"></i>
        @lang('general.edit_app')
    </h1>
@stop
@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered p-4" style="padding: 20px; margin-top: 30px;">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table tabler-bordered">
                                <tbody>
                                    <tr>
                                        <th>@lang('general.application_number')</th>
                                        <th> {{ $application->app_number ?? '' }}</th>
                                    </tr>
                                    <tr>
                                        <th>@lang('general.fullname')</th>
                                        <th> {{ $application->customer->full_name ?? '' }}</th>
                                    </tr>
                                    <tr>
                                        <th>@lang('general.region')</th>
                                        <th> {{ $application->customer->region->name_uz ?? '' }}</th>
                                    </tr>
                                    <tr>
                                        <th>@lang('general.district')</th>
                                        <th> {{ $application->customer->district->name_uz ?? '' }}</th>
                                    </tr>
                                    <tr>
                                        <th>@lang('general.address')</th>
                                        <th> {{ $application->customer->address ?? '' }}</th>
                                    </tr>

                                    <tr>
                                        <th>@lang('general.status')</th>
                                        <th> {{ getStatusText($application->status_id) }}</th>
                                    </tr>

                                    <tr>
                                        
                                        @if ($application->status_id == 'wait_payment')
                                            <th>@lang('general.needpaid')</th>
                                            <th>
                                                <span class="badge badge-danger" style="font-size: 25px;">
                                                    {{ number_format($application->amount ?? '', 0, '', ' ') }} UZS
                                                </span>
                                            </th>
                                        @elseif($application->status_id == 'paid')
                                            <th>@lang('general.paid_amount')</th>
                                            <th>
                                                <span class="badge badge-success" style="font-size: 25px;">
                                                    {{ number_format($application->amount ?? '', 0, '', ' ') }} UZS
                                                </span>

                                            </th>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="gosNumber">
                                <?php
                                $code = substr($application->gosNumber->number, 0, 2);
                                $number = substr($application->gosNumber->number, -6);
                                ?>
                                <span class="code">
                                    {{ $code }}
                                </span>
                                <span>
                                    {{ $number }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a target="_blank" href="{{route('voyager.application.print',$application->id ?? 0)}}" class="btn btn-info">
                            Print
                            </a>
                            @can('wait_payment', $application)
                                @if ($application->status_id == 'wait_payment')
                                    <button class="btn btn-success" data-toggle="modal"
                                        data-target="#paid">@lang('general.paid')</button>

                                    @livewire('application-modal', [
                                    'app_id' => $application->id,
                                    'type' => 'success',
                                    'message' => __('general.amount_paid').": ".number_format($application->amount ?? '', 0,
                                    '', ' ')." UZS",
                                    'status' => 'paid'
                                    ], key(1))
                                    <button class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancel">@lang('general.cancel')</button>
                                    @livewire('application-modal', [
                                        'app_id' => $application->id,
                                        'type' => 'danger',
                                        'message' => __('general.confirm_cancel_action'),
                                        'status' => 'cancel'
                                        ], key(2))
                                @endif
                            @endcan
                                
                            
                            @can('paid', $application)
                                @if ($application->status_id == 'paid')
                                    <button class="btn btn-success" data-toggle="modal"
                                        data-target="#passed">@lang('general.passed')</button>

                                    @livewire('application-modal', [
                                    'app_id' => $application->id,
                                    'type' => 'danger',
                                    'message' => __('general.confirm_passed_action'),
                                    'status' => 'passed'
                                    ], key(3))
                                    <button class="btn btn-danger" data-toggle="modal"
                                        data-target="#failed">@lang('general.failed')</button>

                                    @livewire('application-modal', [
                                    'app_id' => $application->id,
                                    'type' => 'danger',
                                    'message' => __('general.confirm_failed_action'),
                                    'status' => 'failed'
                                    ], key(4))
                                @endif
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
