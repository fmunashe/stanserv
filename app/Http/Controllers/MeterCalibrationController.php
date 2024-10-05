<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeterCalibrationRequest;
use App\Http\Requests\UpdateMeterCalibrationRequest;
use App\Models\MeterCalibration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MeterCalibrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMeterCalibrationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MeterCalibration $meterCalibration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MeterCalibration $meterCalibration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMeterCalibrationRequest $request, MeterCalibration $meterCalibration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MeterCalibration $meterCalibration)
    {
        //
    }

    public function generateCertificate($record): Response
    {
        $record = MeterCalibration::findOrFail($record);

        $verificationLink = env('APP_URL') . "/meterCalibrationCertificate/" . $record->id;

        $qrcode = base64_encode(QrCode::format('png')->size(500)->generate($verificationLink));
        $pdf = Pdf::loadView('meter-certificate', ['record' => $record, 'qrcode' => $qrcode]);
        $pdf->output();
        $canvas = $pdf->getDomPDF()->getCanvas();
        $height = $canvas->get_height();
        $width = $canvas->get_width();
        $canvas->set_opacity(0.2, "Multiply");
        $canvas->page_text($width / 3, $height / 2, 'PASSED', null,
            70, array(0, 0, 0), 2, 2, -30);
        $canvas->page_text($width / 1.15, $height / 1.05, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 12);
        return $pdf->stream($record->meterOwner->company_name . 'meterCalibrationCertificate' . '.pdf');
    }
}
