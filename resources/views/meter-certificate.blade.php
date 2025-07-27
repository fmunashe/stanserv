<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Meter Calibration Certificate</title>
    <link rel="stylesheet" href="{{ public_path('meter-pdf.css') }}" type="text/css">
</head>
<body>
<header>
    <div class="border-text border-top"></div>
    <div class="image-top border-text" style="background-color: #a6d3e2; width: 100%;">
        <table class="w-full" style="padding-left:  1%">
            <tr>
                <td class="w-half">
                    <img src="{{ public_path('images/logo-latest.png') }}" alt="saz" width="80%"/>
                </td>
                <td class="w-half">
                    <h2>Meter Calibration Certificate No. : {{ $record->certificate->certificate_number??null }}</h2>
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
{{--<footer>--}}
{{--    <div class="margin-top">--}}
{{--        <table class="w-full margin-top">--}}
{{--            <tr>--}}
{{--                <td style="width: 40%">--}}

{{--                </td>--}}
{{--                <td style="width: 60%">--}}
{{--                    <table class="w-full">--}}
{{--                        <tr>--}}
{{--                            <td style="width: 80%">--}}
{{--                                <h3>www.sgs-stanserv.com</h3>--}}
{{--                            </td>--}}
{{--                            <td style="width: 50%"><h5>CERTIFICATE--}}
{{--                                    NO. {{$record->certificate->certificate_number??null}}</h5></td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--</footer>--}}
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
<table class="w-full">
    <tr>
        <td class="w-half">
        </td>
        <td class="w-quarter">
            <h4>METER CALIBRATION CERTIFICATE</h4>
        </td>
        <td class="w-half"></td>
    </tr>
</table>

<div class="margin-top">
    <table class="w-full">
        <tr>
            <td class="w-half" style="border-right: gray solid 1px">
                <table class="w-full">
                    <tr>
                        <td class="w-three-quarters">
                            <table class="w-full">
                                <tr>
                                    <td class="w-half">
                                        <span class="uppercase">Meter Owner</span>
                                    </td>
                                    <td class="w-half uppercase">
                                        :<span
                                            style="padding-left: 3%"> {{$record->meterOwner->company_name??null}}</span>
                                    </td>
                                </tr>
                                <br/>
                                <tr>
                                    <td class="w-half">
                                        <span class="uppercase">Location / Place</span>
                                    </td>
                                    <td class="w-half uppercase">
                                        : <span style="padding-left: 3%">{{$record->meterDetail->location??null}}</span>
                                    </td>
                                </tr>
                                <br/>
                                <tr>
                                    <td class="w-half">
                                        <span class="uppercase">Model Of Meter</span>
                                    </td>
                                    <td class="w-half uppercase">
                                        : <span style="padding-left: 3%">{{$record->meterDetail->model??null}}</span>
                                    </td>
                                </tr>
                                <br/>
                                <tr>
                                    <td class="w-half">
                                        <span class="uppercase">Serial Number</span>
                                    </td>
                                    <td class="w-half uppercase">
                                        : <span
                                            style="padding-left: 3%">{{$record->meterDetail->serial_number??null}}</span>
                                    </td>
                                </tr>
                                <br/>
                                <tr>
                                    <td class="w-half">
                                        <span class="uppercase">FLow Rates</span>
                                    </td>
                                    <td class="w-half uppercase">
                                        : <span
                                            style="padding-left: 3%">{{$record->meterDetail->flow_rate??null}}</span>
                                    </td>
                                </tr>
                                <br/>
                                <tr>
                                    <td class="w-half">
                                        <span class="uppercase">Meter Resolution</span>
                                    </td>
                                    <td class="w-half uppercase">
                                        :<span
                                            style="padding-left: 3%"> {{$record->meterDetail->meter_resolution??null}}</span>
                                    </td>
                                </tr>
                                <br/>
                                <tr>
                                    <td class="w-half">
                                        <span class="uppercase">Product Used</span>
                                    </td>
                                    <td class="w-half uppercase">
                                        : <span
                                            style="padding-left: 3%">{{$record->calibration_product_used??null}}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 35%">
                            <div><h5 class="uppercase margin-top">Loading and Offloading meter</h5></div>
                            <table class="w-full" style="border: black solid 2px;  padding: 2%;padding-right: 0">
                                <tr>
                                    <td colspan="2"><h5 class="uppercase margin-top" style="padding-left: 20%"><u>Totaliser Readings</u></h5></td>
                                </tr>
                                <tr>
                                    <td class="w-half">TOT. FINISH</td>
                                    <td class="w-half">:{{$record->totaliserReading->tot_finish??null}}</td>
                                </tr>
                                <tr>
                                    <td class="w-half">TOT. START</td>
                                    <td class="w-half">:{{$record->totaliserReading->tot_start??null}}</td>
                                </tr>
                                <tr>
                                    <td class="w-half">PROD. DRAWN</td>
                                    <td class="w-half">:{{$record->totaliserReading->prod_drawn??null}} ltrs</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
            </td>


            <td class="w-half">
                <table class="w-full">
                    <tr>
                        <td class="w-quarter">
                        </td>
                        <td class="w-half">
                            <h4 class="uppercase"><u>Calibration Method Used</u></h4>
                            <h4 class="uppercase"><u>{{$record->calibration_method??null}}</u> - <u>master meter</u>
                            </h4>
                        </td>
                        <td class="w-quarter">
                            <img src="data:image/png;base64,{{ $qrcode}}" alt="QR Code" height="150" width="150">
                        </td>
                    </tr>
                </table>

                <table class="w-full margin-top">
                    <tr>
                        <td class="w-quarter">
                        </td>
                        <td class="w-half">
                            <h4 class="uppercase"><u>Master Meter Details</u></h4>
                        </td>
                        <td class="w-quarter"></td>
                    </tr>
                </table>

                <table class="w-full margin-top" style="padding-left: 5%">
                    <tr>
                        <td class="w-half uppercase">Type</td>
                        <td class="w-half uppercase">:<span
                                style="padding-left: 3%">{{$record->masterMeter->meterType->meter_type??null}}</span>
                        </td>
                    </tr>
                    <br/>
                    <tr>
                        <td class="w-half uppercase">Model</td>
                        <td class="w-half uppercase">:<span
                                style="padding-left: 3%">{{$record->masterMeter->model??null}}</span></td>
                    </tr>
                    <br/>
                    <tr>
                        <td class="w-half uppercase">Flow Rates</td>
                        <td class="w-half uppercase">:<span
                                style="padding-left: 3%">{{$record->masterMeter->flow_rate??null}}</span></td>
                    </tr>
                    <br/>
                    <tr>
                        <td class="w-half uppercase">Serial Number</td>
                        <td class="w-half uppercase">:<span
                                style="padding-left: 3%">{{$record->masterMeter->serial_number??null}}</span></td>
                    </tr>
                </table>

                <div class="margin-top" style="padding-left: 10%">

                    <table class="w-full">
                        <tr>
                            <td class="w-half"></td>
                            <td>
                                <table style="border: black solid 2px; padding: 2%; padding-right: 0;">
                                    <tr>
                                        <td colspan="2"><h4 class="uppercase margin-top" style="padding-left: 20%"><u>Totaliser Readings</u></h4></td>
                                    </tr>
                                    <br/>
                                    <tr>
                                        <td class="w-half">TOT. FINISH :<span
                                                style="padding-left: 3%">{{$record->masterMeter->totaliserReading->tot_finish??null}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-half">TOT. START :<span
                                                style="padding-left: 3%">{{$record->masterMeter->totaliserReading->tot_start??null}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-half">PROD. DRAWN :<span style="padding-left: 3%">{{$record->masterMeter->totaliserReading->prod_drawn??null}} ltrs</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</div>

<div class="margin-top" style="bottom: 50px">
    <table class="table">
        <tr>
            <th class="non-tr"></th>
            <th class="uppercase tr" colspan="4">Master Meter</th>
            <th class="uppercase tr">Line Meter</th>
            <th></th>
        </tr>
        <tr>
            <th class="tr">Run No</th>
            <th class="tr">Flow Rate (LPM)</th>
            <th class="tr">Volume: IV (Ltrs)</th>
            <th class="tr">Temp</th>
            <th class="tr">Pressure (Bars)</th>
            <th class="tr">Volume (Ltrs)</th>
            <th class="tr">Difference in Litres</th>
            <th class="tr">Meter Factor</th>
            <th class="tr">Percentage Error</th>
            <th class="tr">Remarks</th>
        </tr>
        @if($record)
            @foreach($record->calibrationMeasureDetails as $item)
                <tr class="items"  style="text-align: center">
                    <td class="tr">
                        {{ $item->run_number }}
                    </td>
                    <td class="tr">
                        {{ $item->master_meter_flow_rate }}
                    </td>
                    <td class="tr">
                        {{ $item->master_meter_volume }}
                    </td>
                    <td class="tr">
                        {{ $item->master_meter_temperature }}
                    </td>
                    <td class="tr">
                        {{ $item->master_meter_pressure }}
                    </td>
                    <td class="tr">
                        {{ $item->line_meter_volume }}
                    </td>
                    <td class="tr">
                        {{ $item->difference }}
                    </td>
                    <td class="tr">
                        {{ $item->meter_factor }}
                    </td>
                    <td class="tr">
                        {{ $item->percentage_error }}
                    </td>
                    <td class="tr uppercase">
                        {{ $item->remarks }}
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
</div>

<div class="margin-top">
    <h4><u>METER PASSED CALIBRATION AND ASSIZE TESTS.</u></h4>
</div>

<p>CALIBRATOR SECURED WITH SEALING PLIERS No. <span style="padding-left: 14.3%;padding-right: 2%">=</span>{{$record->sealing_pliers_number??null}}</p>

<p>REGISTER SECURED WITH SEALING PLIERS No. <span style="padding-left: 16%;padding-right: 2%">=</span>{{$record->sealing_pliers_number??null}}</p>

<p>AVERAGE METER % ERROR BEFORE ANY ADJUSTMENTS <span style="padding-left: 11%;padding-right: 1.5%">=</span> {{$record->avg_meter_percentage_error_before_adjustments??null}}<span style="padding-left: 2%">%</span></p>

<p>AVERAGE METER % ERROR FOR THE LAST FOUR READINGS <span style="padding-left: 9.5%;padding-right: 1.5%">=</span> {{$record->avg_meter_percentage_error_for_the_last_four_readings??null}} <span style="padding-left: 2%">%</span></p>
<p>AVERAGE METER FACTOR FOR THE LAST FOUR READINGS <span style="padding-left: 10%;padding-right: 1.5%">=</span> {{$record->avg_meter_factor_for_the_last_four_readings??null}}</p>

<div class="margin-top">
    <h4><u>PLEASE TAKE NOTE OF THE FOLLOWING VERY IMPORTANT INFORMATION</u></h4>
    <table class="margin-top">
        <tr>
            <td class="">
                A) <span style="padding-left: 5%">METER FACTOR</span> <span style="padding-left: 25%">=</span>
            </td>
            <td class="">
                <u><span>CORRECTED VOLUME</span></u>
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>METER UNDER TEST VOLUME</td>
            <td></td>
        </tr>
        <br/>
        <tr class="margin-top">
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="">
                B)<span style="padding-left: 5%"> % ERROR</span> <span  style="padding-left: 39%">=</span>
            </td>
            <td class="">
                <u>CORRECTED VOLUME - METER UNDER TEST VOLUME</u> <span>X</span> 100
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td><span>CORRECTED VOLUME</span>
            </td>
            <td></td>
        </tr>
    </table>
</div>
<div class="margin-top">
    <p>IF METER FACTOR EXCEEDS 1 THEN % ERROR IS POSITIVE THUS THE METER WILL BE OVER DELIVERING</p>
</div>
<div class="margin-top">
    <h4><u>TRACEABILITY OF MEASUREMENT .</u></h4>
    <p>THE ACCURACIES OF ALL MEASUREMENTS ARE TRACEABLE TO NATIONAL STANDARDS
        AS MAINTAINED BY THE TRADE MEASURES (ASSIZE) (AMENDMENT) REGULATIONS
        1989, THROUGH VERIFICATION CERTIFICATE NUMBER 0010.
    </p>
</div>

<div class="margin-top">
    <p class="uppercase">METER WILL BE DUE FOR RE-CALIBRATION AFTER SIX
        MONTHS, {{\Carbon\Carbon::parse($record->date_of_next_calibration??null)->format('d F Y')}} PROVIDED THERE IS NO
        DISTURBANCE, REPAIR WORK DONE ON IT OR DRIFTOUT OF CALIBRATION.</p>
</div>
<div class="margin-top">
    <h4><u>HOWEVER, WE RECOMMEND RE-CALIBRATION TO BE DONE EVERY SIX MONTHS.</u></h4>
</div>
<div class="margin-top">
    <table class="w-full" style="border-spacing: 0 15px;">
        <tr>
            <td class="w-half">DATE OF METER CALIBRATION</td>
            <td><p class="uppercase">:&nbsp;
                    &nbsp; {{\Carbon\Carbon::parse($record->calibration_date??null)->format('d   F   Y')}}</p></td>
        </tr>
        <tr>
            <td class="w-half">DATE OF NEXT RE-CALIBRATION</td>
            <td><p class="uppercase">:&nbsp;
                    &nbsp; {{\Carbon\Carbon::parse($record->next_date_of_calibration??null)->format('d   F   Y')}}</p>
            </td>
        </tr>
        <tr>
            <td class="w-half">CALIBRATED BY TECHNICIAN</td>
            <td><p class="uppercase"> :&nbsp; &nbsp;{{$record->calibrated_by??null}}</p></td>
        </tr>
        <tr>
            <td class="w-half">ASSISTED BY</td>
            <td><p class="uppercase">:&nbsp; &nbsp;{{$record->assisted_by??null}}</p></td>
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
