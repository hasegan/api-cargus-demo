@extends('welcome')

@section('content')
    <div class="content" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="text-center m-3">Calculare Cost Livrare</h3>
            {{-- <a href="#" class="btn btn-secondary backbtn m-3">Inapoi</a> --}}
        </div>

        <form method="get" action="/landed-cost-calculated"
            class="row justify-content-center border text-center col-6 mx-auto" id="calculate-landed-cost-form">
            @csrf
            <div class="content">
                <div id="shipperdetalis">
                    <h3>Sender Details</h3>

                    <label for="senderCountry" class="form-label my-2">Select Country<b>* </b>:</label>
                    <select name="senderCountry" id="senderCountry" class="form-select">Select Country:
                        <option value="" selected disabled> - </option>
                        @foreach ($jsonDataCountries as $countryData)
                            <option value="{{ $countryData['cca2'] }}"> {{ $countryData['name']['common'] }} </option>
                        @endforeach
                    </select>

                    {{--
                    wait for the KEY from countrystatecity API to get access to all cities from every country
                    (in this case we need cities from every european country)
                     --}}

                    {{--
                    TODO:
                        - create a new select with cities from the selected country (sender)
                        - create a new input field for postal code (sender)

                        - do the same thing for the receiver ( country, city, postal code) and then make smth with "package data"
                    --}}


                </div>

        </form>

    </div>
@endsection
