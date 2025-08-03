<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengawasDashboardController extends Controller
{
    /**
     * Display the dashboard for pengawas.
     */
    public function index()
    {
        // Logic to display the pengawas dashboard
        return view('pengawas.dashboard');
    }
}
