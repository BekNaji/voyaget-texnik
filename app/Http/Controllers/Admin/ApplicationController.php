<?php

namespace App\Http\Controllers\Admin;

use App\Models\Application;
use App\Models\CarBrand;
use App\Models\Customer;
use App\Models\GosNumber;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use TCG\Voyager\Facades\Voyager;
use Auth;

class ApplicationController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{

    protected $view  = 'vendor.voyager.application.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $modelName = app($dataType->model_name);
    
        $applications = Application::query()->orderBy('id','DESC');
        
        if(auth()->user()->role_id != 1){
            $applications->where('branch_id',auth()->user()->branch->id);
        }
        

        if(auth()->user()->can('wait_payment',  $modelName)){
            $applications->orWhere('status_id', 'wait_payment');
        }
        if(auth()->user()->can('paid', $modelName) || auth()->user()->can('wait_payment', $modelName)){
            $applications->orWhere('status_id','paid');
        }

        if(auth()->user()->can('passed',$modelName)){
            $applications->orWhere('status_id','passed');
        }
        if(auth()->user()->can('failed',$modelName)){
            $applications->orWhere('status_id','failed');
        }
        $applications = $applications->paginate();
        
        if($request->status_id)
        {
            $this->authorize('search', $modelName);
            $applications = Application::orderBy('id','DESC')->where('status_id',$request->status_id)->paginate();
        }

        $applicationCount  = Application::count();

        return view($this->view.'browse',compact('applications','modelName','applicationCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $application = new Application();
        return view('vendor.voyager.application.create',compact('application'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'gos_number' => 'required',
            'car_brand' => 'required',
            'car_color' => 'required',
            'full_name' => 'required',
            'amount' => 'required',
            'release_date' => 'required',
            'tech_passport_number' => 'required'
        ]);

        $customer = Customer::where('full_name',$request->full_name)
                            ->where('region_id', $request->region)
                            ->where('district_id',$request->district)->first();

                            
        if(empty($customer))
        {
            $customer = Customer::create([
                'full_name' => $request->full_name,
                'region_id' => $request->region,
                'district_id' => $request->district,
                'address' => $request->address
            ]);
        }
        $gos_number = strtoupper(str_replace([' ',','],'', $request->gos_number));
        $gosNumber = GosNumber::where('number', $gos_number)->first();
        if(empty($gosNumber)){
            $gosNumber = GosNumber::create(['number' => $gos_number]);
        }

        $carBrand = CarBrand::where('title', $request->car_brand)->first();
        if(empty($carBrand)){
            $carBrand = CarBrand::create(['title' => $request->car_brand]);
        }

        $gos_number_customer = DB::table('gos_number_customer_id')
                                ->where('gos_number_id', $gosNumber->id)
                                ->where('customer_id', $customer->id)->first();
        if(empty($gos_number_customer))
        {
            DB::table('gos_number_customer_id')->insert([
                'gos_number_id' => $gosNumber->id,
                'customer_id' => $customer->id
            ]);
        }

        $amount = str_replace([' ','UZS',','],'',$request->amount);
        
        $application = Application::create([
            'amount' => $amount,
            'customer_id' => $customer->id,
            'gos_number_id' => $gosNumber->id,
            'car_color_id' => $request->car_color,
            'car_brand_id' => $carBrand->id,
            'status_id' => 'wait_payment',
            'release_date' => date("Y-m-d H:i:s", strtotime($request->release_date)),
            'tech_passport_number' => $request->tech_passport_number,
            'branch_id' => auth()->user()->branch_id
        ]);

        $application = Application::find($application->id);
        $application->update(['app_number' => sprintf("%08d",$application->id)]);

        return redirect()->route('voyager.application.index')->with([
            'alert-type' => 'success',
            'message' => __('successfully_created')
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {   
        $application = Application::findOrFail($id);

     
        return view($this->view.'show',compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
        $application = Application::findOrFail($id);
        $this->authorize('edit',$application);
        return view($this->view.'edit',compact('application'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'gos_number' => 'required',
            'car_brand' => 'required',
            'car_color' => 'required',
            'full_name' => 'required',
            'amount' => 'required',
            'release_date' => 'required',
            'tech_passport_number' => 'required'
        ]);

        $customer = Customer::find($request->customer_id);
        $customer->update([
            'full_name' => $request->full_name,
            'region_id' => $request->region,
            'district_id' => $request->district,
            'address' => $request->address
        ]);
        
        $gos_number = strtoupper(str_replace([' ',','],'', $request->gos_number));
        $gosNumber = GosNumber::find($request->gosnumber_id);
        $gosNumber->update(['number' => $gos_number]);

        $carBrand = CarBrand::where('title', $request->car_brand)->first();
        if(empty($carBrand)){
            $carBrand = CarBrand::create(['title' => $request->car_brand]);
        }else{
            $carBrand->update(['title' => $request->car_brand]);
        }

        $amount = str_replace([' ','UZS',','],'',$request->amount);
        
        $application = Application::find($id);
        $this->authorize('update',$application);
        $application->update([
            'amount' => $amount,
            'car_color_id' => $request->car_color,
            'car_brand_id' => $carBrand->id,
            'release_date' => date("Y-m-d H:i:s", strtotime($request->release_date)),
            'tech_passport_number' => $request->tech_passport_number,
        ]);

        return back()->with([
            'alert-type' => 'success',
            'message' => __('successfully_updated')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $this->authorize('delete',$application);
        $application->delete();
        return back()->with([
            'alert-type' => 'success',
            'message' => 'Successfully deleted'
        ]);
    }

    public function customList(Request $request)
    {
        $applications = Application::orderBy('id','DESC')->paginate();
        return view($this->view.'browse',compact('applications'));
        
    }

    public function changeStatus(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $application->update([
            'status_id' => Crypt::decryptString($request->status_id)
        ]);

        return back()->with([
            'alert-type' => 'success',
            'message' => 'Successfully updated'
        ]);
    }

    public function print($id)
    {
        $application = Application::findOrFail($id);
        return view($this->view.'print',compact('application'));
    }
}
