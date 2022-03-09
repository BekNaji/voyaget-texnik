<div>
    <div class="form-group">
        <label for="gos_number">@lang('general.gos_number')</label>
        <input name="gos_number" type="text" class="form-control" wire:keydown="getGosNumbers" wire:model="gosNumber" >
        @if(isset($gosNumbers))
        <div class="list-group">
            @foreach ($gosNumbers as $itemGosNumber)
            <a href="javascript:;" class="list-group-item list-group-item-action" wire:click="gosNumberSelected('{{$itemGosNumber->number}}')" >{{$itemGosNumber->number }}</a>
            @endforeach
        </div>
        @endif
    </div>
</div>
