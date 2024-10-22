<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePumpCalibrationRequest;
use App\Http\Requests\UpdatePumpCalibrationRequest;
use App\Models\PumpCalibration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PumpCalibrationController extends Controller
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
    public function store(StorePumpCalibrationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PumpCalibration $pumpCalibration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PumpCalibration $pumpCalibration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePumpCalibrationRequest $request, PumpCalibration $pumpCalibration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PumpCalibration $pumpCalibration)
    {
        //
    }

    public function generateCertificate($record): Response
    {
        $record = PumpCalibration::findOrFail($record);

        $verificationLink = env('APP_URL')."/pumpCalibrationCertificate/".$record->id;

        $qrcode = base64_encode(QrCode::format('png')->size(500)->generate($verificationLink));
        $pdf = Pdf::loadView('pump-certificate', ['record' => $record, 'qrcode' => $qrcode]);
        $pdf->output();
        $canvas = $pdf->getDomPDF()->getCanvas();
        $height = $canvas->get_height();
        $width = $canvas->get_width();
        $canvas->set_opacity(1.0, "Multiply");
//        $canvas->page_text($width / 3, $height / 2, 'PASSED', null,
//            70, array(0, 0, 0), 2, 2, -30);
        $canvas->page_text($width / 1.15, $height / 1.05, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 12);
        return $pdf->stream($record->pumpOwner->company_name . 'PumpCalibrationCertificate' . '.pdf');
    }
}
