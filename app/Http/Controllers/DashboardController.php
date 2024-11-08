<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalHospitals = Hospital::count();
        $totalPatients = Patient::count();
        $totalUsers = User::count();

        return view('dashboard', compact('totalHospitals', 'totalPatients', 'totalUsers'));
    }
}
