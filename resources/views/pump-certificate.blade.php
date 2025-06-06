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
    <div class="image-top border-text" style="background-color: #a6d3e2; width: 100%; padding-top: 1%; margin-bottom: 2%">
        <table class="w-full" style="padding-left:  1%">
            <tr>
                <td class="w-half">
                    <img src="{{ public_path('images/logo-latest.png') }}" alt="saz" width="80%"/>
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
                    <img src="{{public_path('/images/saz-logo3.svg')}}" alt="SAZ" width="110" height="110"/>
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

<div class="margin-top">
    <table class="w-full">
        <tr>
            <td class="w-half">
                <table class="w-full">
                    <tr>
                        <td class="w-half"><span class="uppercase">Client</span></td>
                        <td class="w-half">: {{ $record->pumpOwner->company_name??null }}</td>
                    </tr>
                    <tr>
                        <td class="w-half"><span class="uppercase">Certificate No.</span></td>
                        <td class="w-half"> : {{ $record->certificate->certificate_number??null }}</td>
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
                <div><h4 class="uppercase" style="text-align: right; margin-top: 5%"><u>Totaliser Readings</u></h4>
                </div>

                <table class="w-full" style="text-align: right">
                    <tr>
                        <td class="w-half">TOT. FINISH</td>
                        <td class="w-quarter"><span>:</span></td>
                        <td class="w-quarter"> {{number_format($record->totaliserReading->first()->tot_finish,0,'','')??null}}</td>
                    </tr>
                    <tr>
                        <td class="w-half">TOT. START</td>
                        <td class="w-quarter"><span>:</span></td>
                        <td class="w-quarter">{{number_format($record->totaliserReading->first()->tot_start,0,'','')??null}}</td>
                    </tr>
                    <tr>
                        <td class="w-half">PROD. DRAWN</td>
                        <td class="w-quarter"><span>:</span></td>
                        <td class="w-quarter"> {{number_format($record->totaliserReading->first()->prod_drawn,0,'','')??null}}</td>
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
                                <td class="w-quarter"> {{number_format($reading->tot_finish,0,'','')??null}}</td>
                            </tr>
                            <tr>
                                <td class="w-half">TOT. START</td>
                                <td class="w-quarter"><span>:</span></td>
                                <td class="w-quarter">{{number_format($reading->tot_start,0,'','')??null}}</td>
                            </tr>
                            <tr>
                                <td class="w-half">PROD. DRAWN</td>
                                <td class="w-quarter"><span>:</span></td>
                                <td class="w-quarter"> {{number_format($reading->prod_drawn,0,'','')??null}}</td>
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
    <h4 class="uppercase">Calibration Runs</h4>
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
                        <td class="tr">{{is_numeric($item->corrected_volume)?number_format($item->corrected_volume,3,'.',''):$item->corrected_volume}}
                        </td>
                        <td class="tr">
                            {{ is_numeric($item->pump_under_test_volume)?number_format($item->pump_under_test_volume,3,'.',''):$item->pump_under_test_volume }}
                        </td>
                        <td class="tr">
                            {{ is_numeric($item->difference)?number_format($item->difference,3,'.',''):$item->difference }}
                        </td>
                        <td class="tr">
                            {{ $item->corrective_action }}
                        </td>
                    </tr>
            @endforeach
        @endif
    </table>
</div>

<div class="margin-top uppercase">
    <h4><u>{{$record->pumpCalibrationStatus->status??""}}</u></h4>
</div>

<p>CALIBRATOR SECURED USING SEALING PLIERS No.: {{$record->sealing_pliers_number??null}}</p>

<p class="uppercase">AVERAGE PUMP PERCENTAGE ERROR BEFORE ANY
    ADJUSTMENTS: {{$record->avg_pump_percentage_error_before_adjustments??null}} {{$record->avg_pump_percentage_error_before_adjustments=="Not Adjusted"?"":"%"}}</p>
<p class="uppercase">{{$record->average_pump_percentage_error_wording??null}}
    : {{$record->avg_pump_percentage_error_before_assize??null}} %</p>

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
            <td>:{{\Carbon\Carbon::parse($record->calibration_date)->format('d-m-Y')??null}}</td>
        </tr>
        <tr>
            <td class="w-half">DATE OF NEXT CALIBRATION</td>
            <td>:{{\Carbon\Carbon::parse($record->next_date_of_calibration)->format('d-m-Y')??null}}</td>
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
            <td><img src="{{ $signaturePath!=null? public_path('storage/' . basename($signaturePath)):"" }}" alt="____________________________"
                     height="50"
                     width="100"></td>
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
