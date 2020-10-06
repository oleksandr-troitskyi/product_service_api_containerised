<?php

namespace App\Http\Controllers;

use App\Models\Product;

class OpenAPIController extends Controller
{
    public function index()
    {
        return response('OK');
    }

    public function products()
    {
        $products = Product::all();

        return response()->json($products);
    }
}
