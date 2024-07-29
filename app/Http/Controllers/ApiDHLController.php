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
}
