<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UrgentCurier;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    protected $urgentCurier;

    public function __construct(UrgentCurier $urgentCurier)
    {
        $this->urgentCurier = $urgentCurier;
    }


    // UrgentOnlineAPI - not working
    public function login(Request $request)
    {
        // $fields = [
        //     'UserName' => config('api.username'),
        //     'Password' => config('api.password')
        // ];

        // $json = json_encode($fields);
        // $login = $this->urgentCurier->CallMethod('LoginUser', $json, 'POST');
        // dd($login);
        // if ($login['status'] != "200") {
        //     return response()->json(['message' => 'Login failed'], $login['status']);
        // } else {
        //     $token = json_decode($login['message']);
        //     return response()->json(['token' => $token], 200);
        // }


        // also not working
        $url = "https://urgentcargus.azure-api.net/api/LoginUser";
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        # Request headers
        $headers =
            [
                'Content-Type' => 'application/json',
                'Ocp-Apim-Trace' => 'true',
                'Cache-Control' => 'no-cache',
                'Ocp-Apim-Subscription-Key' => config('api.key'),
            ];

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


        # Request body
        $request_body = [
            'UserName' => config('api.username'),
            'Password' => config('api.password')
        ];

        curl_setopt($curl, CURLOPT_POSTFIELDS, $request_body);

        $resp = curl_exec($curl);
        curl_close($curl);
        var_dump($resp);
    }


    // Web Express API - working
    public function loginUser()
    {
        $url = "https://urgentcargus.azure-api.net/v4/api/loginuser";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache',
            'Ocp-Apim-Subscription-Key' => config('api.key'),
        ])->post($url, [
            'userName' => config('api.username'),
            'password' => config('api.password'),
        ]);

        if ($response->successful()) {
            echo "SUCCESS";
        } else {
            echo "ERROR";
        }

        return $response->json();
    }
}
