<input type="hidden" value="{{$application->customer->id ?? ''}}" name="customer_id">
<input type="hidden" value="{{$application->gosNumber->id ?? ''}}" name="gosnumber_id">
@can('delete',$application)
<div class="form-group">
    <label for="">@lang('general.status')</label>
    <select name="status_id" id="" class="form-control">
        <option value="">@lang('general.select_one')</option>
        <option value="wait_payment">@lang('general.waiting_payment')</option>
        <option value="paid">@lang('general.paid')</option>
        <option value="passed">@lang('general.test_passed')</option>
        <option value="failed">@lang('general.test_failed')</option>
        <option value="sent_to_master">@lang('general.send_to_master')</option>
        <option value="cancel">@lang('general.cancelled')</option>
    </select>
</div>
@endcan
<div class="form-group">
    <label for="amoun">@lang('general.amount')</label>
    <input type="text" class="form-control" id="amount" name="amount"  data-decimal="," value="{{old('amount') ?? $application->amount ?? ''}}">
</div>
<div class="form-group">
    <label for="">@lang('general.release_date')</label>
    <input name="release_date" type="text" data-inputmask="'mask': '99.99.9999'" class="form-control" id="release_date" value="{{old('release_date') ?? ($application->release_date ? date('d.m.Y',strtotime($application->release_date)) : '')}}">
</div>
<div class="form-group">
    <label for="">@lang('general.tech_passport_number')</label>
    <input id="tech_passport_number" type="text" name="tech_passport_number" class="form-control" value="{{old('tech_passport_number') ?? $applicaton->tech_passport_number ?? ''}}">
</div>
@livewire('gos-number',['gosNumber' => old('gos_number') ?? $application->gosNumber->number ?? ''])

@livewire('car-brand',['carBrand' => old('car_brand') ?? $application->carBrand->title ?? ''])
@livewire('car-color',['carColor' => old('carColor') ?? $application->carColor->title ?? ''])

@livewire('customer',['customer' => old('full_name') ?? $application->customer->full_name ?? ''])
@livewire('address',[
    'address' => old('address') ?? $application->customer->address ?? '',
    'region' => old('region') ?? $application->customer->region->id ?? '',
    'district' => old('district') ?? $application->customer->district->id ?? '',
    ])


@section('javascript')
    <script>
        $(document).ready(function(){
            $('#amount').maskMoney({
                thousands:' ', 
                decimal:'.', 
                allowZero:false, 
                precision: 0,
                suffix: ' UZS'
            });

            $('#release_date').inputmask("99.99.9999"); 
         
        });
        console.log("testtest");
        
    </script>
@endsection