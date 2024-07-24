@extends('welcome')

@section('content')
    <div class="content" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
        <h3 class="text-center mb-5 mt-3">Selectare Punct de Preluare/Trimitere Colet DHL</h3>

        <form method="get" action="/dhl-locations" class="row justify-content-center border text-center col-6 mx-auto"
            id="delivery-form">
            @csrf

            <div class="form-content">
                {{-- get data from json file --}}
                <div class="mb-3 fs-5 d-block first">
                    <label for="locationPoint" class="form-label my-2">Selecteaza locatitatea<b>* </b>:</label>

                    <select id="locationPoint" name="locationPoint" required class="form-select">

                        <option value="" selected disabled> - </option>
                        @foreach ($jsonDataCities as $jsonLocation)
                            <option value="{{ $jsonLocation['city'] }}">{{ $jsonLocation['city'] }}</option>
                        @endforeach
                    </select>
                    <span id="check-locationPoint" class="text-danger"></span>
                </div>

                <!--Check locations Button -->
                <button type="submit" class="btn btn-success search mt-4 py-2 px-4 mb-3">
                    Cauta
                </button>
            </div>
    </div>

    </form>
    </div>
@endsection
