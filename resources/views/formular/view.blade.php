@extends('welcome')

@section('content')
    <div class="content" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
        <h3 class="text-center mb-5 mt-3">Formular Trimitere Colet</h3>

        <form method="post" action="/package-details" class="row justify-content-center border text-center col-6 mx-auto"
            id="delivery-form">
            @csrf

            <div class="form-content">

                <div class="progress my-3 p-0">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>

                {{-- get data from json file --}}
                <div class="mb-3 fs-5 d-block first">
                    <label for="deliveryStart" class="form-label my-2">Localitate de expediere<b>* </b>:</label>

                    {{-- <input type="text" class="form-control" id="deliveryStart" name="deliveryStart"
                    onkeydown="removeWarning(this.id)">
                    <span id="check-deliveryStart" class="text-danger"></span> --}}

                    <select id="deliveryStart" name="deliveryStart" onchange="removeWarning(this.id)" class="form-select">
                        <option value="0" selected disabled> - </option>
                        @foreach ($jsonDataCities as $jsonLocation)
                            <option value="{{ $jsonLocation['city'] }}">{{ $jsonLocation['city'] }}</option>
                        @endforeach
                    </select>
                    <span id="check-deliveryStart" class="text-danger"></span>
                </div>

                {{-- get data from csv file --}}
                <div class="mb-3 fs-5 d-none">
                    <label for="deliveryEnd" class="form-label my-2">Localitate de destinatie<b>* </b>:</label>

                    {{-- <input type="text" class="form-control" id="deliveryEnd" name="deliveryEnd"
                    onkeydown="removeWarning(this.id)">
                    <span id="check-deliveryEnd" class="text-danger"></span> --}}

                    <select id="deliveryEnd" name="deliveryEnd" onchange="removeWarning(this.id)" class="form-select">
                        <option value="0" selected disabled> - </option>
                        @foreach ($csvDataCities as $csvLocation)
                            <option value="{{ $csvLocation[0] }}">{{ $csvLocation[0] }}</option>
                        @endforeach
                    </select>
                    <span id="check-deliveryEnd" class="text-danger"></span>
                </div>

                <div class="mt-2 text-center packageDetailsSection d-none last">
                    <div class="mt-2 mb-3 d-flex fs-5 coletDetails justify-content-center">
                        <label for="deliveryEnd" class="form-label">Tip colet<b>* </b>:</label>
                        <select class="form-select" aria-label="Default select example" name="packageType">
                            <option selected value="colet">Colet</option>
                            <option value="plic">Plic</option>
                        </select>
                    </div>

                    <div class="mb-3 fs-5 coletDetails">
                        <div class="d-flex justify-content-center">
                            <label for="weight" class="form-label">Greutate<b>* </b>: </label>
                            <input type="text" class="form-control" id="weight" name="packageWeight"
                                onkeydown="removeWarning(this.id)">
                            <div class="px-2 bg-gradient addon"><span>kg</span></div>
                        </div>

                        <span id="check-weight" class="text-danger"></span>
                    </div>

                    <div class="mb-3 fs-5 coletDetails">
                        <div class="d-flex justify-content-center">

                            <label for="height" class="form-label">Înălțime<b>* </b>: </label>
                            <input type="text" class="form-control" id="height" name="packageHeight"
                                onkeydown="removeWarning(this.id)">
                            <div class="px-2 bg-gradient addon"><span>cm</span></div>
                        </div>

                        <span id="check-height" class="text-danger"></span>
                    </div>

                    <div class="mb-3 fs-5 coletDetails">
                        <div class="d-flex justify-content-center">
                            <label for="width" class="form-label">Lățime<b>* </b>: </label>
                            <input type="text" class="form-control" id="width" name="packageWidth"
                                onkeydown="removeWarning(this.id)">
                            <div class="px-2 bg-gradient addon"><span>cm</span></div>
                        </div>

                        <span id="check-width" class="text-danger"></span>
                    </div>

                    <div class="mb-3 fs-5 coletDetails">
                        <div class="d-flex justify-content-center">
                            <label for="length" class="form-label">Lungime<b>* </b>: </label>
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
                        <button onclick="backQuestion()" type="button" class="btn btn-outline-success backBtn">
                            <i class="fa-solid fa-arrow-left"></i> Back
                        </button>
                        <button onclick="nextQuestion()" type="button" class="btn btn-outline-success nextBtn">
                            Next <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>

                    <button onclick="submitForm()" type="button" class="btn btn-success d-none saveBtn mt-4 py-2 px-4">
                        Submit
                    </button>
                </div>
            </div>

        </form>
    </div>
@endsection
