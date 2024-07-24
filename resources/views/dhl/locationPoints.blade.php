@extends('welcome')

@section('content')
    <div class="content" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="text-center m-3">Puncte de Preluare/Trimitere Colet din Orasul: {{ $city }}</h3>
            <a href="/dhl" class="btn btn-secondary backbtn m-3">Inapoi</a>
        </div>
        <div id="accordion">
            <div class="card text-center col-6 m-auto">
                @foreach ($response->locations as $location)
                    <div class="card-header " id="heading_{{ $location->name }}">
                        <a data-toggle="collapse" href="#{{ $location->name }}" role="button" aria-expanded="false"
                            aria-controls="{{ $location->name }}">
                            <h5 class="mb-0">
                                {{ $location->name }}
                            </h5>
                        </a>
                    </div>

                    <div id="{{ $location->name }}" class="collapse border-bottom"
                        aria-labelledby="heading_{{ $location->name }}" data-parent="#accordion">
                        <div class="card-body">
                            <svg style="width: 15px; margin-top: -40px;" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                            </svg>
                            <?php
                            $address = $location->place->address;
                            ?>
                            <div><strong>Adresa:</strong><br>
                                {{ $address->streetAddress }}
                            </div>

                            <div>
                                <strong>Program:</strong><br>
                                <?php
                                $openingHours = $location->openingHours;
                                foreach ($openingHours as $hours) {
                                    $dayOfWeek = basename($hours->dayOfWeek);
                                    $opens = $hours->opens;
                                    $closes = $hours->closes;
                                    echo "<span>$dayOfWeek: $opens - $closes</span> <br>";
                                } ?>
                            </div>

                            <div>
                                <strong>Servicii:</strong><br>
                                <?php
                                $serviceTypes = $location->serviceTypes;
                                foreach ($serviceTypes as $service) {
                                    echo "<span>$service</span><br>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
