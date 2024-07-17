<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UrgentCurier;

class ApiController extends Controller
{
    protected $urgentCurier;

    public function __construct(UrgentCurier $urgentCurier)
    {
        $this->urgentCurier = $urgentCurier;
    }

    public function login(Request $request)
    {
        $fields = [
            'UserName' => $request->input('userName'),
            'Password' => $request->input('password')
        ];

        $json = json_encode($fields);
        $login = $this->urgentCurier->CallMethod('LoginUser', $json, 'POST');

        if ($login['status'] != "200") {
            return response()->json(['message' => 'Login failed'], $login['status']);
        } else {
            $token = json_decode($login['message']);
            return response()->json(['token' => $token], 200);
        }
    }
}
