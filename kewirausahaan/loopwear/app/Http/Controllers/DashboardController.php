<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = \App\Models\Mbarang::count();
        $barangTersedia = \App\Models\Mbarang::where('status', 'available')->count();
        $totalUser = \App\Models\User::count();

        return view('admin.dashboard', compact('totalBarang', 'barangTersedia', 'totalUser'));
    }
}
