<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackageDetailsController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'deliveryStart' => $request->deliveryStart,
            'deliveryEnd' => $request->deliveryEnd,
            'packageType' => $request->packageType,
            'packageWeight' => $request->packageWeight,
            'packageHeight' => $request->packageHeight,
            'packageWidth' => $request->packageWidth,
            'packageLength' => $request->packageLength,
        ];

        return $data;
    }
}
