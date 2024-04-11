<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function search($search)
    {
        $brand = Brand::where('name_brand',$search);
        return $brand;
    }

    public function addBrand($name)
    {
        $brand = Brand::create([
            "name_brand" => $name
        ]);
        return $brand;
    }

}
