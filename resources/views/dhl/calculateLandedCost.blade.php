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
                <div id="shipperDetalis" class="d-block first">
                    <h3>Sender Details</h3>

                    <div class="mb-3 shippmentDetails">
                        <div class="d-flex justify-content-center">
                            <label for="senderCountry" class="form-label my-2">Country<b>* </b>:</label>
                            <select name="senderCountryCode" id="senderCountry" class="form-select"
                                onchange="removeWarning(this.id);">
                                <option value="0" selected disabled> - </option>
                                @foreach ($jsonDataCountries as $countryData)
                                    <option value="{{ $countryData['cca2'] }}"> {{ $countryData['name']['common'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <span id="check-senderCountry" class="text-danger"></span>
                    </div>

                    <div class="mb-3 shippmentDetails">
                        <div class="d-flex justify-content-center">
                            <label for="senderCityName" class="form-label my-2">City<b>* </b>:</label>
                            <select name="senderCityName" id="senderCityName" class="form-select"
                                onchange="removeWarning(this.id);">
                                <option value="">Select country first</option>
                            </select>
                        </div>
                        <span id="check-senderCityName" class="text-danger"></span>
                    </div>

                    <div class="mb-3 shippmentDetails">
                        <div class="d-flex justify-content-center">
                            <label for="senderAddress" class="form-label">Address<b>* </b>: </label>
                            <input type="text" class="form-control" id="senderAddress" name="senderAddress"
                                onkeydown="removeWarning(this.id)">
                        </div>
                        <span id="check-senderAddress" class="text-danger"></span>
                    </div>


                    <div class="mb-3 shippmentDetails">
                        <div class="d-flex justify-content-center">
                            <label for="senderPostalCode" class="form-label">Postal Code<b>* </b>: </label>
                            <input type="text" class="form-control" id="senderPostalCode" name="senderPostalCode"
                                onkeydown="removeWarning(this.id)">
                        </div>
                        <span id="check-senderPostalCode" class="text-danger"></span>
                    </div>

                    {{--
                    wait for the KEY from countrystatecity API to get access to all cities from every country
                    (in this case we need cities from every european country)
                     --}}
                </div>

                <div id="receiverDetalis" class="d-none">
                    <h3>Receiver Details</h3>

                    <div class="mb-3 shippmentDetails">
                        <div class="d-flex justify-content-center">
                            <label for="receiverCountry" class="form-label my-2">Country<b>* </b>:</label>
                            <select name="receiverCountryCode" id="receiverCountry" class="form-select"
                                onchange="removeWarning(this.id)">
                                <option value="0" selected disabled> - </option>
                                @foreach ($jsonDataCountries as $countryData)
                                    <option value="{{ $countryData['cca2'] }}"> {{ $countryData['name']['common'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <span id="check-receiverCountry" class="text-danger"></span>
                    </div>


                    <div class="mb-3 shippmentDetails">
                        <div class="d-flex justify-content-center">
                            <label for="receiverCityName" class="form-label my-2">City<b>* </b>:</label>
                            <select name="receiverCityName" id="receiverCityName" class="form-select"
                                onchange="removeWarning(this.id);">
                                <option value="">Select country first</option>
                            </select>
                        </div>
                        <span id="check-receiverCityName" class="text-danger"></span>
                    </div>

                    <div class="mb-3 shippmentDetails">
                        <div class="d-flex justify-content-center">
                            <label for="receiverAddress" class="form-label">Address<b>* </b>: </label>
                            <input type="text" class="form-control" id="receiverAddress" name="receiverAddress"
                                onkeydown="removeWarning(this.id)">
                        </div>
                        <span id="check-receiverAddress" class="text-danger"></span>
                    </div>

                    <div class="mb-3 shippmentDetails">
                        <div class="d-flex justify-content-center">
                            <label for="receiverPostalCode" class="form-label">Postal Code<b>* </b>: </label>
                            <input type="text" class="form-control" id="receiverPostalCode" name="receiverPostalCode"
                                onkeydown="removeWarning(this.id)">
                        </div>
                        <span id="check-receiverPostalCode" class="text-danger"></span>
                    </div>
                </div>

                <div id="packageDetalis" class="d-none last">
                    <h3>Package Details</h3>
                    {{--
                    <div class="mt-2 mb-3 d-flex fs-5 coletDetails justify-content-center">
                        <label for="deliveryEnd" class="form-label">Tip colet<b>* </b>:</label>
                        <select class="form-select" aria-label="Default select example" name="packageType">
                            <option selected value="colet">Colet</option>
                            <option value="plic">Plic</option>
                        </select>
                    </div> --}}

                    <div class="mb-3 fs-5 coletDetails">
                        <div class="d-flex justify-content-center">
                            <label for="weight" class="form-label">Weight<b>* </b>: </label>
                            <input type="text" class="form-control" id="weight" name="packageWeight"
                                onkeydown="removeWarning(this.id)">
                            <div class="px-2 bg-gradient addon"><span>kg</span></div>
                        </div>

                        <span id="check-weight" class="text-danger"></span>
                    </div>

                    <div class="mb-3 fs-5 coletDetails">
                        <div class="d-flex justify-content-center">

                            <label for="height" class="form-label">Height<b>* </b>: </label>
                            <input type="text" class="form-control" id="height" name="packageHeight"
                                onkeydown="removeWarning(this.id)">
                            <div class="px-2 bg-gradient addon"><span>cm</span></div>
                        </div>

                        <span id="check-height" class="text-danger"></span>
                    </div>

                    <div class="mb-3 fs-5 coletDetails">
                        <div class="d-flex justify-content-center">
                            <label for="width" class="form-label">Width<b>* </b>: </label>
                            <input type="text" class="form-control" id="width" name="packageWidth"
                                onkeydown="removeWarning(this.id)">
                            <div class="px-2 bg-gradient addon"><span>cm</span></div>
                        </div>

                        <span id="check-width" class="text-danger"></span>
                    </div>

                    <div class="mb-3 fs-5 coletDetails">
                        <div class="d-flex justify-content-center">
                            <label for="length" class="form-label">Length<b>* </b>: </label>
                            <input type="text" class="form-control" id="length" name="packageLength"
                                onkeydown="removeWarning(this.id)">
                            <div class="px-2 bg-gradient addon"><span>cm</span></div>
                        </div>

                        <span id="check-length" class="text-danger"></span>
                    </div>

                </div>

                <!-- Next, back & submit button -->
                <div class="p-3">
                    <div class="controlButtons">
                        <button onclick="backQuestionDHL()" type="button" class="btn btn-outline-success backBtn">
                            <i class="fa-solid fa-arrow-left"></i> Back
                        </button>
                        <button onclick="nextQuestionDHL()" type="button" class="btn btn-outline-success nextBtn">
                            Next <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>

                    <button onclick="submitFormDHL()" type="button"
                        class="btn btn-success d-none saveBtn mt-4 py-2 px-4">
                        Submit
                    </button>
                </div>
        </form>

    </div>
@endsection
