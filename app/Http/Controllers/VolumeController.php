<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVolumeRequest;
use App\Http\Requests\UpdateVolumeRequest;
use App\Models\Volume;

class VolumeController extends Controller
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
    public function store(StoreVolumeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Volume $volume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Volume $volume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVolumeRequest $request, Volume $volume)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Volume $volume)
    {
        //
    }
}