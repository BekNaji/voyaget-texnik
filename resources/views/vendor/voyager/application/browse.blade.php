@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing') . ' ' . 'Applications')

@section('css')
    <style>
        .nowrap {
            white-space: nowrap;
        }

    </style>
@stop

@section('page_header')
    <div class="container-fluid">

        <h1 class="page-title">
            <i class="icon voyager-file-text"></i> @lang('general.apps')
        </h1>

        @can('add', $modelName)
            <a href="{{ route('voyager.application.create') }}" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> <span>@lang('general.add_new')</span>
            </a>
        @endcan
        @can('search', $modelName)
            <button data-toggle="collapse" data-target="#filterform" class="btn btn-primary">@lang('general.filter')</button>
        @endcan
        <div class="panel panel-default collapse" id="filterform">
            <div class="panel panel-heading">@lang('general.filter_form')</div>
            <div class="panel-body">
                <form action="{{ route('voyager.application.index') }}" method="GET">
                    <div class="form-group">
                        <label for="">@lang('general.status')</label>
                        <select name="status_id" class="form-control">
                            <option value="">@lang('general.select_one')</option>
                            <option value="wait_payment"
                                {{ app('request')->input('status_id') == 'wait_payment' ? 'selected' : '' }}>
                                @lang('general.wait_payment')</option>
                            <option value="paid" {{ app('request')->input('status_id') == 'paid' ? 'selected' : '' }}>
                                @lang('general.paid')</option>
                            <option value="cancelled"
                                {{ app('request')->input('status_id') == 'cancelled' ? 'selected' : '' }}>
                                @lang('general.cancelled')</option>
                            <option value="passed" {{ app('request')->input('status_id') == 'passed' ? 'selected' : '' }}>
                                @lang('general.passed')</option>
                            <option value="failed" {{ app('request')->input('status_id') == 'failed' ? 'selected' : '' }}>
                                @lang('general.failed')</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">
                            @lang('general.search')
                        </button>
                        <a href="{{ route('voyager.application.index') }}">Reset Filter</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body ">
                        Заявки: {{ count($applications ?? []) }} <br><br>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="nowrap">@lang('general.app_number')</th>
                                        <th>@lang('general.amount')</th>
                                        <th>@lang('general.gos_number')</th>
                                        <th>@lang('general.car_brand')</th>
                                        <th>@lang('general.customer')</th>
                                        <th>@lang('general.status')</th>
                                        <th></th>
                                        @can('delete', $modelName)
                                            <th></th>
                                        @endcan
                                        @can('edit', $modelName)
                                            <th></th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($applications as $row)
                                        <tr class="{{ getStatusColor($row->status_id ?? '') }}">
                                            <td class="nowrap">{{ $loop->iteration }}</td>
                                            <td class="nowrap">{{ $row->app_number ?? '' }}</td>
                                            <td class="nowrap">
                                                {{ number_format($row->amount ?? '0', 0, '', ' ') }} UZS</td>
                                            <td class="nowrap"><span>{{ $row->gosNumber->number ?? '' }}</span>
                                            </td>
                                            <td class="nowrap">{{ $row->carBrand->title ?? '' }}</td>
                                            <td class="nowrap">{{ $row->customer->full_name ?? '' }}</td>
                                            <td class="nowrap">{{ getStatusText($row->status_id ?? '') }}</td>
                                            <td>

                                                <a href="{{ route('voyager.application.show', $row->id) }}" title="Show"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="voyager-receipt"></i> <span
                                                        class="hidden-xs hidden-sm">@lang('general.show')</span>
                                                </a>

                                            </td>
                                            @can('delete', $modelName)
                                                <td>
                                                    <a href="javascript:;" title="Delete" data-toggle="modal"
                                                        data-target="#deleteConfirm-{{ $row->id }}"
                                                        class="btn btn-sm btn-danger pull-right delete">
                                                        <i class="voyager-trash"></i> <span
                                                            class="hidden-xs hidden-sm">@lang('general.delete')</span>
                                                    </a>
                                                    <div class="modal modal-danger fade in"
                                                        id="deleteConfirm-{{ $row->id }}" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                    <h4 class="modal-title">
                                                                        <i class="voyager-trash"></i>
                                                                        Are you sure you want to delete this Application?
                                                                    </h4>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form
                                                                        action="{{ route('voyager.application.destroy', $row->id) }}"
                                                                        method="POST">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <input type="submit"
                                                                            class="btn btn-danger pull-right delete-confirm"
                                                                            value="Yes, Delete it!">
                                                                    </form>
                                                                    <button type="button" class="btn btn-default pull-right"
                                                                        data-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div>
                                                </td>
                                            @endcan
                                            @can('edit', $modelName)
                                                <td>
                                                    <a class="btn btn-sm btn-primary pull-right edit"
                                                        href="{{ route('voyager.application.edit', $row->id) }}">
                                                        <i class="voyager-edit"></i>
                                                        <span class="hidden-xs hidden-sm">@lang('general.edit')</span>
                                                    </a>
                                                </td>
                                            @endcan
                                        </tr>
                                    @empty
                                    Не найдено
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $applications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('css')

    <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">

@stop

@section('javascript')

@stop
