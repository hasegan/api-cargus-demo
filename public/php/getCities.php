<?php

// use Illuminate\Support\Facades\Config;

// $value =  Config::get('api.get_cities_key');


$dataCC = $_POST['country_code'];
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/' . $dataCC . '/cities',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        // 'X-CSCAPI-KEY:' . $value,
        'X-CSCAPI-KEY: xxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    ]
]);

$response = curl_exec($curl);

curl_close($curl);

$html = '';

if ($response !== false) {

    $response = json_decode($response);
    if (is_iterable($response)) {
        $html .= '<option value="" selected disabled>Select City</option>';
        foreach ($response as $city) {
            $html .= '<option value="' . $city->name . '">' . $city->name . '</option>';
        }
    }
} else {
    $html .= '<option value="">No cities</option>';
}

echo $html;
