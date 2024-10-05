<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Meter Calibration Certificate</title>
    <link rel="stylesheet" href="{{ public_path('pdf.css') }}" type="text/css">
</head>
<body>
<header>

</header>

<table class="w-full">
    <tr>
        <td class="w-half">
{{--            <img src="{{ public_path('images/logo.png') }}" alt="saz"/>--}}
        </td>
        <td class="w-half">
{{--            <h4>Pump Calibration Certificate No. : {{ $record->certificate->certificate_number??null }}</h4>--}}
        </td>
    </tr>
</table>

<div class="margin-top">
    <table class="w-full">
        <tr>
            <td class="w-half">
                <table class="w-full">
                    <tr>
                        <td class="w-three-quarters"><span class="uppercase">Pump Calibration Certificate No.</span></td>
                        <td class="w-half"> : {{ $record->certificate->certificate_number??null }}</td>
                    </tr>
                    <tr>
                        <td class="w-half"><span class="uppercase">Pump Owner</span></td>
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
                        <td class="w-half"><span class="uppercase">Flow Rate</span></td>
                        <td class="w-half">: {{ $record->pumpDetail->flow_rate??null }}</td>
                    </tr>
                    <tr>
                        <td class="w-half"><span class="uppercase">Product Used For Calibration</span></td>
                        <td class="w-half">: {{ $record->calibration_product_used??null }}</td>
                    </tr>
                </table>
            </td>
            <td class="w-quarter">
                <img src="data:image/png;base64,{{ $qrcode}}" alt="QR Code" height="100" width="130">
                <div><h4 class="uppercase"><u>Totaliser Readings</u></h4></div>
                <table class="w-full">
                    <tr>
                        <td class="w-half">TOT. FINISH</td>
                        <td class="w-half">: {{$record->totaliserReading->tot_finish??null}}</td>
                    </tr>
                    <tr>
                        <td class="w-half">TOT. START</td>
                        <td class="w-half">: {{$record->totaliserReading->tot_start??null}}</td>
                    </tr>
                    <tr>
                        <td class="w-half">PROD. DRAWN</td>
                        <td class="w-half">: {{$record->totaliserReading->prod_drawn??null}}</td>
                    </tr>
                </table>
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
    <table class="w-full">
        <tr>
            <td class="w-quarter"><strong class="uppercase">Standard</strong></td>
            <td class="w-quarter"><strong class="uppercase">Serial Number</strong></td>
            <td class="w-quarter"><strong class="uppercase">Material of Construction</strong></td>
        </tr>
        <tr>
            <td class="w-quarter">{{$record->standard??null}}</td>
            <td class="w-quarter">{{$record->serial_number??null}}</td>
            <td class="w-quarter">{{$record->material_of_construction??null}}</td>
        </tr>
    </table>
</div>

<div class="margin-top">
    <h4 class="uppercase">20000 & 5000 M/Litre Assized Test Measure</h4>
</div>

<div class="margin-top" style="bottom: 50px">
    <table class="table">
        <tr>
            <th class="tr">Corrected Volume</th>
            <th class="tr">Pump Under Test Volume</th>
            <th class="tr">Difference in Litres</th>
            <th class="tr">Corrective Action Taken</th>
        </tr>
        @if($record)
            @foreach($record->calibrationMeasureDetails as $item)
                <tr class="items">
                    <td class="tr">
                        {{ $loop->index+1 .') '.$item->corrected_volume }}
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

<p>AVERAGE PUMP % ERROR BEFORE ANY ADJUSTMENTS: {{$record->avg_pump_percentage_error_before_adjustments??null}}</p>

<p>AVERAGE PUMP % ERROR FOR THE LAST FIVE READINGS BEFORE
    ASSIZE: {{$record->avg_pump_percentage_error_before_assize??null}}</p>

<div class="margin-top">
    <h4><u>TRACEABILITY OF MEASUREMENT .</u></h4>
    <p>THE ACCURACIES OF ALL MEASUREMENTS ARE TRACEABLE TO NATIONAL STANDARDS
        AS MAINTAINED BY THE TRADE MEASURES (ASSIZE) (AMENDMENT) REGULATIONS
        1989, THROUGH VERIFICATION CERTIFICATE NUMBER 0010.
    </p>
</div>
<div class="margin-top">
    <h4><u>IN ACCORDANCE WITH THE GOVERNMENT TRADE MEASURES (ASSIZE) REGULATIONS THIS
            PUMP {{$record->pumpDetail->serial_number??null}} USED FOR TRADE PURPOSES.</u></h4>
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
        <tr>
            <td class="w-half"></td>
            <td>FOR, AND ON BEHALF OF STANSERV GENUINE SERVICES (Pvt) Ltd</td>
        </tr>
    </table>
</div>
</body>
</html>
