<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class ApiDHLController extends Controller
{
    public function index(Request $request)
    {
        // Load data from JSON file
        $jsonContents = File::get(base_path('public\\json\\ro.json'));
        $jsonDataCities = json_decode(json: $jsonContents, associative: true);

        return view('dhl.selectLocation')->with(compact('jsonDataCities'));
    }

    public function locations(Request $request)
    {
        $city = $request->input('locationPoint');

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.dhl.com/location-finder/v1/find-by-address?countryCode=RO&addressLocality=" . $city,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "DHL-API-Key:  " . config('api.dhl_key_locations')
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);

            return view('dhl.locationPoints')->with(compact('response', 'city'));

            // // Check if locations exist in the response
            // if (isset($response->locations) && is_array($response->locations)) {
            //     foreach ($response->locations as $location) {
            //         // Extract basic details
            //         $url = $location->url;
            //         $name = $location->name;
            //         $distance = $location->distance;

            //         // Extract address details
            //         $address = $location->place->address;
            //         $countryCode = $address->countryCode;
            //         $postalCode = $address->postalCode;
            //         $addressLocality = $address->addressLocality;
            //         $streetAddress = $address->streetAddress;

            //         // Extract geographic details
            //         $geo = $location->place->geo;
            //         $latitude = $geo->latitude;
            //         $longitude = $geo->longitude;

            //         // Extract opening hours
            //         $openingHours = $location->openingHours;

            //         // Extract service types
            //         $serviceTypes = $location->serviceTypes;

            //         // Display the data
            //         echo "<h2>$name</h2>";
            //         echo "<p>URL: $url</p>";
            //         echo "<p>Distance: $distance meters</p>";
            //         echo "<p>Address: $streetAddress, $addressLocality, $postalCode, $countryCode</p>";
            //         echo "<p>Coordinates: Latitude: $latitude, Longitude: $longitude</p>";

            //         // Display opening hours
            //         echo "<h3>Opening Hours:</h3>";
            //         echo "<ul>";
            //         foreach ($openingHours as $hours) {
            //             $dayOfWeek = basename($hours->dayOfWeek); // Extract the day of the week from the URL
            //             $opens = $hours->opens;
            //             $closes = $hours->closes;
            //             echo "<li>$dayOfWeek: $opens - $closes</li>";
            //         }
            //         echo "</ul>";

            //         // Display service types
            //         echo "<h3>Service Types:</h3>";
            //         echo "<ul>";
            //         foreach ($serviceTypes as $service) {
            //             echo "<li>$service</li>";
            //         }
            //         echo "</ul>";
            //     }
            // } else {
            //     echo "<p>No locations found.</p>";
            // }
        }
    }

    // doesn't work because we don't have a valid tracking number (I think)
    public function shipmentTracking()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            // status 401
            // CURLOPT_URL => "https://api-test.dhl.com/track/shipments?trackingNumber=00340434292135100162",

            //statusd 404 : No shipment with given tracking number found.
            CURLOPT_URL => "https://api-eu.dhl.com/track/shipments?trackingNumber=00340434292135100162",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "DHL-API-Key: " . config('api.dhl_key_tracking'),
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return view('dhl.trackingView')->with(compact('response'));
        }
    }

    public function calculateLandedCost(Request $request)
    {

        $jsonContents = File::get(base_path('public\\json\\european-countries.json'));
        $jsonDataCountries = json_decode(json: $jsonContents, associative: true);

        // dd($jsonDataCountries[0]['name']['common']);
        return view('dhl.calculateLandedCost')->with(compact('jsonDataCountries'));
    }


    function verifyPostalCode(Request $request)
    {
        $url = "https://www.gs1.org/voc/postalCode";

        $countryCode =  $request->input('senderCountryCode');
        $postalCode =  $request->input('senderPostalCode');
        // dd($postalCode, $countryCode);

        // Create the data array to be sent in the POST request
        $data = json_encode(array(
            "postalCode" => $postalCode,
            "countryCode" => $countryCode
        ));

        // Initialize cURL session
        $ch = curl_init($url);

        // Set the options for cURL transfer
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ));

        // Execute the cURL request and get the response
        $response = curl_exec($ch);

        // Check for errors
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            return array("error" => $error);
        }

        // Close the cURL session
        curl_close($ch);

        // Decode the JSON response
        $responseData = json_decode($response, true);

        dd($responseData);
        // Return the response data
        return $responseData;
    }

    public function getStates(Request $request)
    {
        $dataCC = $request->input('country_code');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/' . $dataCC . '/states',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'X-CSCAPI-KEY:' . config('api.get_cities_key'),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $html = '';

        if ($response !== false) {
            $response = json_decode($response);
            if (is_iterable($response)) {
                $html .= '<option value="0" selected disabled>Select State</option>';
                foreach ($response as $state) {
                    $state->name = str_replace("County", "", $state->name);
                    $html .= '<option value="' . $state->iso2 . '">' . $state->name . '</option>';
                }
            }
        } else {
            $html .= '<option value="">No states</option>';
        }
        return $html;
    }

    public function getCities(Request $request)
    {
        $dataCC = $request->input('country_code');
        $dataSC = $request->input('state_code');
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/' . $dataCC . '/states/' . $dataSC . '/cities',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'X-CSCAPI-KEY:' . config('api.get_cities_key'),
            ]
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        $html = '';

        if ($response !== false) {
            $response = json_decode($response);
            if (is_iterable($response)) {
                $html .= '<option value="0" selected disabled>Select City</option>';
                foreach ($response as $city) {
                    $html .= '<option value="' . $city->name . '">' . $city->name . '</option>';
                }
            }
        } else {
            $html .= '<option value="">No cities</option>';
        }

        return $html;
    }

    public function getPostalCode(Request $request)
    {
        $dataCC = $request->input('country_code');
        $dataCN = $request->input('city_name');
        $dataSN = $request->input('sender_address');

        $searchData = "'" . $dataSN . ","  . $dataCN . ","  .  $dataCC . "'";
        // dd($searchData);


        $geocoder = new \OpenCage\Geocoder\Geocoder(config('api.pc_key'));
        # no need to URI encode the query, the library does this for you
        $result = $geocoder->geocode($searchData);

        $dataResult = $result['results'];
        $postalCode = $dataResult[0]['components']['postcode'];
        // dd($dataResult[0]['components']['postcode']);

        $html = '';

        if ($result !== false) {
            // $html .=  ' <input type="text" class="form-control" id="senderPostalCode" name="senderPostalCode"
            //                     placeholder=" ' . $postalCode . '" value="' . $postalCode . '"disabled readonly>';
            $html .= $postalCode;

            // $('#senderPostalCode').val($po)
        } else {
            $html .= 'no valid street name';
        }

        return $html;
    }
}
