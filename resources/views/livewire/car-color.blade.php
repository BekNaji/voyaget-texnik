<div>
    <div class="form-group">
        <label for="test">@lang('general.car_color')</label>
        <select name="car_color" id="car_color" class="form-control">
            <option value="">@lang('general.select_one')</option>
            @foreach ($carColors as $itemCarColor)
                <option value="{{$itemCarColor->id}}" {{$carColor == $itemCarColor->title ? 'selected' : ''}}>{{$itemCarColor->title}}</option>
            @endforeach
        </select>
    </div>
    {{--<div class="form-group">
        <label for="gos_number">Car color</label>
        <input name="car_color" type="text" class="form-control" wire:keydown="getCarColor" wire:model="carColor">
        @if(isset($carColors))
        <div class="list-group">
            @foreach ($carColors as $itemCarColor)
            <a href="javascript:;" class="list-group-item list-group-item-action" wire:click="carColorSelected('{{$itemCarColor->title}}')" >{{$itemCarColor->title }}</a>
            @endforeach
        </div>
        @endif
    </div>--}}
</div>
