<div>
    <div class="form-group">
        <label for="gos_number">@lang('general.car_brand')</label>
        <input name="car_brand" type="text" class="form-control" wire:keydown="getCarBrand" wire:model="carBrand">
        @if(isset($carBrands))
        <div class="list-group">
            @foreach ($carBrands as $itemCarBrand)
            <a href="javascript:;" class="list-group-item list-group-item-action" wire:click="carBrandSelected('{{$itemCarBrand->title}}')" >{{$itemCarBrand->title }}</a>
            @endforeach
        </div>
        @endif
    </div>
</div>
