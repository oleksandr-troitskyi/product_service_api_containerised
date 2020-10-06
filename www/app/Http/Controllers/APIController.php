<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('auth');

        $this->user = Auth::user();
    }

    public function user()
    {
        return response()->json($this->user->name);
    }

    public function getUserProducts()
    {
        $user = Auth::user();

        return response()->json($this->user->purchasedProducts);
    }

    public function purchaseProduct(Request $request)
    {
        $validator = \Validator::make(
            $request->input(),
            [
                'sku' => 'required|exists:App\Models\Product,sku',
            ]
        );

        if ($validator->fails()) {
            return response(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $product = Product::where('sku', $request->input('sku'))->first();
        if ($this->user->purchasedProducts()->where('sku', $request->input('sku'))->count() === 0) {
            $this->user->purchasedProducts()->attach($product);
        }

        return response(['success' => true], 201);
    }

    public function deleteProductFromPurchased(Request $request)
    {
        $validator = \Validator::make(
            $request->input(),
            [
                'sku' => 'required|exists:App\Models\Product,sku',
            ]
        );

        if ($validator->fails()) {
            return response(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $product = Product::where('sku', $request->input('sku'))->first();
        $this->user->purchasedProducts()->detach($product);

        return response(['success' => true], 201);
    }
}
