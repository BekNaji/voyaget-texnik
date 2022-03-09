

<div id="{{$status}}" class="modal fade modal-{{$type}}" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@lang('general.confirm_alert')</h4>
            </div>
            <div class="modal-body">
                <p>{{$message}}</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('voyager.application.change.status',$app_id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status_id" value="{{ Crypt::encryptString($status) }}">
                    <button class="btn btn-success">@lang('general.confirm')</button>
                    <button type="button" class="btn btn-default"
                        data-dismiss="modal">@lang('general.close')</button>
                </form>

            </div>
        </div>

    </div>
</div>

