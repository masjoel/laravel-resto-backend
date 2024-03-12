<?php

namespace App\Http\Controllers\Api;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return response()->json([
            'status' => 'success',
            'data' => $discounts
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'value' => 'required',
        ]);

        $discount = Discount::create($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $discount
        ], 201);
    }
}
