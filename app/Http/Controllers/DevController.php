<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer, App\Models\District, App\Models\Region;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DevController extends Controller
{
    public function index()
    {
        


        /*for($i = 0; $i < 1000; $i++)
        {
            $regionId = rand(1,14);
            $district = District::select('id')->where('region_id', $regionId)->get()->toArray();
            $randomId = array_rand($district);
            $districtId = $district[$randomId]['id'];

            $faker = Faker::create('ru_RU');
            Customer::create([
                'district_id' => $districtId,
                'region_id' => $regionId,
                'full_name' => $faker->name,
                'address' => $faker->address
            ]);
        }*/
    }
}
