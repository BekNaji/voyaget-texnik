<div>
    <div class="form-group">
        <label for="full_name">@lang('general.customer')</label>
        <input name="full_name" type="text" class="form-control" wire:keydown="getCustomer" wire:model="customer">
        @if(isset($customers))
        <div class="list-group">
            @foreach ($customers as $itemCustomer)
            <a href="javascript:;" class="list-group-item list-group-item-action" wire:click="customerSelected('{{$itemCustomer->full_name}}')" >{{$itemCustomer->full_name }}</a>
            @endforeach
        </div>
        @endif
    </div>
</div>