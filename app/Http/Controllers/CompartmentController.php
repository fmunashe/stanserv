<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompartmentRequest;
use App\Http\Requests\UpdateCompartmentRequest;
use App\Models\Compartment;

class CompartmentController extends Controller
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
    public function store(StoreCompartmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Compartment $compartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compartment $compartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompartmentRequest $request, Compartment $compartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compartment $compartment)
    {
        //
    }
}
