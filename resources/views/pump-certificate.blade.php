<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pump Calibration Certificate</title>
    <link rel="stylesheet" href="{{ public_path('pump-pdf.css') }}" type="text/css">
</head>
<body>
<header>
    <div class="border-text border-top"></div>
    <div class="image-top border-text" style="background-color: #a6d3e2; width: 100%">
{{--        <img src="{{ public_path('images/logo2.png') }}" alt="saz" width="400"/>--}}
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <img src="{{ public_path('images/logo2.png') }}" alt="saz" width="90%"/>
                </td>
                <td class="w-half">
                    <h2>Pump Calibration Certificate No. : {{ $record->certificate->certificate_number??null }}</h2>
                </td>
            </tr>
        </table>
    </div>
</header>
<left>
    <div class="border-text border-left"></div>
</left>
<right>
    <div class="border-text border-right"></div>
</right>
<footer>
    <div class="margin-top" style="background-color: #a6d3e2;margin: 0.5%">
        <table class="w-full">
            <tr>
                <td style="width: 2%"></td>
                <td style="width: 18%">
                    <img src="{{public_path('/images/saz-logo2.png')}}" alt="SAZ" width="110" height="100"/>
                </td>
                <td style="width: 80%">
                    <table class="w-full">
                        <tr>
                            <td style="width: 80%"><h6 class="red">ISO 45001: 2018 OH&S MANAGEMENT SYSTEM CERTIFIED</h6>
                            </td>
                            <td style="width: 50%"><h6 class="red">&copy; CERTIFICATE
                                    NO. {{$record->certificate->certificate_number??null}}</h6></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div class="border-text border-bottom"></div>
</footer>
{{--<table class="w-full">--}}
{{--    <tr>--}}
{{--        <td class="w-half">--}}
{{--                        <img src="{{ public_path('images/logo.png') }}" alt="saz"/>--}}
{{--        </td>--}}
{{--        <td class="w-half">--}}
{{--            --}}{{--            <h4>Pump Calibration Certificate No. : {{ $record->certificate->certificate_number??null }}</h4>--}}
{{--        </td>--}}
{{--    </tr>--}}
{{--</table>--}}

<div class="margin-top">
    <table class="w-full">
        <tr>
            <td class="w-half">
                <table class="w-full">
                    <tr>
                        <td class="w-half"><span class="uppercase">Certificate No.</span></td>
                        <td class="w-half"> : {{ $record->certificate->certificate_number??null }}</td>
                    </tr>
                    <tr>
                        <td class="w-half"><span class="uppercase">Client</span></td>
                        <td class="w-half">: {{ $record->pumpOwner->company_name??null }}</td>
                    </tr>
                    <tr>
                        <td class="w-half"><span class="uppercase">Pump type</span></td>
                        <td class="w-half">: {{ $record->pumpDetail->pumpType->pump_type??null }}</td>
                    </tr>
                    <tr>
                        <td class="w-half"><span class="uppercase">Location / Place</span></td>
                        <td class="w-half">: {{ $record->pumpDetail->location??null }}</td>
                    </tr>
                    <tr>
                        <td class="w-half"><span class="uppercase">Model</span></td>
                        <td class="w-half">: {{ $record->pumpDetail->model??null }}</td>
                    </tr>
                    <tr>
                        <td class="w-half"><span class="uppercase">Serial Number</span></td>
                        <td class="w-half">: {{ $record->pumpDetail->serial_number??null }}</td>
                    </tr>
                    <tr>
                        <td class="w-half"><span class="uppercase">Flow Rate (LPM)</span></td>
                        <td class="w-half">: {{ $record->pumpDetail->flow_rate??null }}</td>
                    </tr>
                    <tr>
                        <td class="w-half"><span class="uppercase">Product Used</span></td>
                        <td class="w-half">: {{ $record->calibrationProduct->name??null }}</td>
                    </tr>
                </table>
            </td>
            <td class="w-quarter">
                <table>
                    <tr style="text-align: right">
                        <td><img src="data:image/png;base64,{{ $qrcode}}" alt="QR Code" height="100" width="130"></td>
                    </tr>
                </table>
                <div><h4 class="uppercase" style="text-align: right"><u>Totaliser Readings</u></h4></div>

                <table class="w-full" style="text-align: right">
                    <tr>
                        <td class="w-half">TOT. FINISH</td>
                        <td class="w-quarter"><span>:</span></td>
                        <td class="w-quarter"> {{$record->totaliserReading->first()->tot_finish??null}}</td>
                    </tr>
                    <tr>
                        <td class="w-half">TOT. START</td>
                        <td class="w-quarter"><span>:</span></td>
                        <td class="w-quarter">{{$record->totaliserReading->first()->tot_start??null}}</td>
                    </tr>
                    <tr>
                        <td class="w-half">PROD. DRAWN</td>
                        <td class="w-quarter"><span>:</span></td>
                        <td class="w-quarter"> {{$record->totaliserReading->first()->prod_drawn??null}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="padding-top: 15px"></td>
                    </tr>
                </table>

                @if(count($record->totaliserReading)>1)
                    @foreach($record->totaliserReading as $reading)
                        @if($loop->index ==0)
                            @continue
                        @endif
                        <div><h4 class="uppercase" style="text-align: right"><u>Assize Runs</u></h4></div>
                        <table class="w-full" style="text-align: right">
                            <tr>
                                <td class="w-half">TOT. FINISH</td>
                                <td class="w-quarter"><span>:</span></td>
                                <td class="w-quarter"> {{$reading->tot_finish??null}}</td>
                            </tr>
                            <tr>
                                <td class="w-half">TOT. START</td>
                                <td class="w-quarter"><span>:</span></td>
                                <td class="w-quarter">{{$reading->tot_start??null}}</td>
                            </tr>
                            <tr>
                                <td class="w-half">PROD. DRAWN</td>
                                <td class="w-quarter"><span>:</span></td>
                                <td class="w-quarter"> {{$reading->prod_drawn??null}}</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="padding-top: 15px"></td>
                            </tr>
                        </table>
                    @endforeach
                @endif
            </td>
        </tr>
    </table>
</div>

<div class="margin-top">
    <h4 class="uppercase"><u>Calibration Method Used</u></h4>
    <p>{{$record->calibration_method??null}}</p>
</div>
<div class="margin-top">
    <h4 class="uppercase"><u>Test Measure Details</u></h4>
    <table class="w-full table">
        <tr>
            <th class="tr">Standard</th>
            <th class="tr">Serial Number</th>
            <th class="tr">Material of Construction</th>
        </tr>
        @foreach($record->calibrationStandards as $standard)
            <tr class="items" style="text-align: center">
                <td class="tr">{{$standard->standard??null}}</td>
                <td class="tr">{{$standard->serial_number??null}}</td>
                <td class="tr">{{$standard->material_of_construction??null}}</td>
            </tr>
        @endforeach
    </table>
</div>

<div class="margin-top">
    <h4 class="uppercase">20000 & 5000 M/Litre Assized Test Measure</h4>
</div>

<div class="margin-top" style="bottom: 50px">
    <table class="table">
        <tr>
            <th class="tr">#</th>
            <th class="tr">Corrected Volume</th>
            <th class="tr">Pump Under Test Volume</th>
            <th class="tr">Difference in Litres</th>
            <th class="tr">Corrective Action Taken</th>
        </tr>
        @if($record)
            @foreach($record->calibrationMeasureDetails as $item)
                <tr class="items" style="text-align: center">
                    <td class="tr">
                        {{ $loop->index+1 }}
                    </td>
                    <td class="tr">{{$item->corrected_volume }}
                    </td>
                    <td class="tr">
                        {{ $item->pump_under_test_volume }}
                    </td>
                    <td class="tr">
                        {{ $item->difference }}
                    </td>
                    <td class="tr">
                        {{ $item->corrective_action }}
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
</div>

<div class="margin-top">
    <h4><u>PUMP PASSED CALIBRATION AND ASSIZE TEST.</u></h4>
</div>

<p>CALIBRATOR SECURED USING SEALING PLIERS No.: {{$record->sealing_pliers_number??null}}</p>

<p class="uppercase">AVERAGE PUMP % ERROR BEFORE ANY
    ADJUSTMENTS: {{$record->avg_pump_percentage_error_before_adjustments??null}}</p>
<p class="uppercase">{{$record->average_pump_percentage_error_wording??null}}
    : {{$record->avg_pump_percentage_error_before_assize??null}}</p>

<div class="margin-top">
    <h4><u>TRACEABILITY OF MEASUREMENT .</u></h4>
    <p>THE ACCURACIES OF ALL MEASUREMENTS ARE TRACEABLE TO NATIONAL STANDARDS
        AS MAINTAINED BY THE TRADE MEASURES (ASSIZE) (AMENDMENT) REGULATIONS
        1989, THROUGH VERIFICATION CERTIFICATE NUMBER 0010.
    </p>
</div>
<div class="margin-top">
    <h4>
        <u>
            @if($record->pumpDetail->mode =="Commercial")
                IN ACCORDANCE WITH THE GOVERNMENT TRADE MEASURES (ASSIZE) REGULATIONS THIS
                PUMP MUST NOT BE USED FOR TRADE PURPOSES.
            @elseif($record->pumpDetail->mode =="Commercial Trade")
                IN ACCORDANCE WITH THE GOVERNMENT TRADE MEASURES (ASSIZE) REGULATIONS THIS
                PUMP CAN BE USED FOR TRADE PURPOSES.

            @elseif($record->pumpDetail->mode =="Retail")
                IN ACCORDANCE WITH THE GOVERNMENT TRADE MEASURES (ASSIZE) REGULATIONS THIS
                PUMP CAN BE USED FOR TRADE PURPOSES.
            @endif
        </u>
    </h4>
</div>
<div class="margin-top">
    <h4><u>WE RECOMMEND PUMP CALIBRATION TO BE DONE EVERY SIX MONTHS.</u></h4>
</div>
<div class="margin-top">
    <table class="w-full" style="border-spacing: 0 15px;">
        <tr>
            <td class="w-half">DATE OF CALIBRATION</td>
            <td>:{{$record->calibration_date??null}}</td>
        </tr>
        <tr>
            <td class="w-half">DATE OF NEXT CALIBRATION</td>
            <td>:{{$record->next_date_of_calibration??null}}</td>
        </tr>
        <tr>
            <td class="w-half">CALIBRATED BY TECHNICIAN</td>
            <td>:{{$record->calibrated_by??null}}</td>
        </tr>
        <tr>
            <td class="w-half">ASSISTED BY</td>
            <td>:{{$record->assisted_by??null}}</td>
        </tr>
        <tr>
            <td class="w-half">TRADE MEASURES INSPECTOR</td>
            <td>:{{$record->trade_measures_inspector??null}}</td>
        </tr>
        <tr>
            <td class="w-half">AUTHORIZED SIGNATURE</td>
            <td><img src="{{ $record->signature}}" alt="Signature" height="50" width="400"></td>
        </tr>
    </table>
    <table class="w-full" style="border-spacing: 0 15px;">
        <tr>
            <td class="w-quarter"></td>
            <td class="w-three-quarters">FOR, AND ON BEHALF OF STANSERV GENUINE SERVICES (Pvt) Ltd</td>
        </tr>
    </table>
</div>
</body>
</html>
