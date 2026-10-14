<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function createBillig(Request $request)
    {
        $validatedData = $request->validate([
            'record_date' => 'required|date',
            'meter_reading' => 'required|numeric',
            'units_used' => 'required|numeric',
            'amount' => 'required|numeric',
            'plot_id' => 'required|integer|exists:plots,id',
        ]);
    }
}