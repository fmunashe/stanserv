<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePumpCalibrationStatusRequest;
use App\Http\Requests\UpdatePumpCalibrationStatusRequest;
use App\Models\PumpCalibrationStatus;

class PumpCalibrationStatusController extends Controller
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
    public function store(StorePumpCalibrationStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PumpCalibrationStatus $pumpCalibrationStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PumpCalibrationStatus $pumpCalibrationStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePumpCalibrationStatusRequest $request, PumpCalibrationStatus $pumpCalibrationStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PumpCalibrationStatus $pumpCalibrationStatus)
    {
        //
    }
}
