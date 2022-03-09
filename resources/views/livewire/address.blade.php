<div>
    <div class="form-group">
        <label for="region">@lang('general.region')</label>
        <select name="region" id="region" class="form-control" wire:model="region" wire:change="getDistricts">
            <option value="">Select one</option>
            @foreach ($regions as $itemRegion)
                <option value="{{ $itemRegion->id }}">{{ $itemRegion->name_uz }}</option>
            @endforeach
        </select>
    </div>

    
    <div class="form-group">
        <label for="district">@lang('general.district')</label>
        <select name="district" id="district" class="form-control">
            @if(!empty($districts))
                @foreach ($districts as $itemDistrict)
                    <option value="{{$itemDistrict->id}}">{{$itemDistrict->name_uz}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label for="address">@lang('general.address')</label>
        <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{$address ?? ''}}</textarea>
    </div>
   
</div>
