

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title',__('general.create_application'))

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-file-text"></i>
        @lang('general.create_application')
    </h1>
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                            class="form-edit-add"
                            action="{{route('voyager.application.store')}}"
                            method="POST" enctype="multipart/form-data">
                        

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @include('vendor.voyager.application.form')
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                                <button type="submit" class="btn btn-primary save">@lang('general.send_to_casher')</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    
@stop

