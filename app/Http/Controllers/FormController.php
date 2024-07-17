<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;


class FormController extends Controller
{
    public function index(Request $request)
    {
        // Load data from JSON file
        $jsonContents = File::get(base_path('public\\json\\ro.json'));
        $jsonDataCities = json_decode(json: $jsonContents, associative: true);

        // Load data from CSV file
        if (($open = fopen("csv\\ro.csv", "r")) !== false) {
            while (($csvData = fgetcsv($open, 1000, ",")) !== false) {
                $csvDataCities[] = $csvData;
            }

            fclose($open);
        }

        return view('formular.view')->with(compact('jsonDataCities', 'csvDataCities'));
    }
}
