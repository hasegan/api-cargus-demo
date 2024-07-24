<?php

namespace App\Services;

class UrgentCurier
{
    private $Curl;
    public $url = 'https://urgentcargus.azure-api.net/api';

    public function __construct()
    {
        $this->Curl = curl_init();
        curl_setopt($this->Curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->Curl, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($this->Curl, CURLOPT_TIMEOUT, 3);
    }

    public function CallMethod($function, $parameters = "", $verb, $token = null)
    {
        curl_setopt($this->Curl, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($this->Curl, CURLOPT_CUSTOMREQUEST, $verb);
        curl_setopt($this->Curl, CURLOPT_URL, $this->url . '/' . $function);

        if ($function == "LoginUser") {
            curl_setopt($this->Curl, CURLOPT_HTTPHEADER, [
                'Ocp-Apim-Subscription-Key' => config('api.key'),
                'Ocp-Apim-Trace' => 'true',
                'Content-Type' => 'application/json',
                'Cache-Control' => 'no-cache',
                'Content-Length' => strlen($parameters)
            ]);
        }
        // else {
        //     curl_setopt($this->Curl, CURLOPT_HTTPHEADER, [
        //         'Ocp-Apim-Subscription-Key' => config('api.key'),
        //         'Ocp-Apim-Trace' => 'true',
        //         'Authorization' => 'Bearer ' . $token,
        //         'Content-Type' => 'application/json',
        //         'Content-Length' => strlen($parameters)
        //     ]);
        // }



        $result = curl_exec($this->Curl);
        $header = curl_getinfo($this->Curl);

        // dd($header);

        $output['message'] = $result;
        $output['status'] = $header['http_code'];
        return $output;
    }
}
