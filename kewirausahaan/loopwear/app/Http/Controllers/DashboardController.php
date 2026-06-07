<?php

namespace App\Http\Controllers;

use App\Models\Mbarang;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Mbarang::count();
        $barangTersedia = Mbarang::where('status', 'available')->count();
        $totalUser = User::count();
        $totalVoucher = Voucher::where('aktif', true)->count();

        return view('admin.dashboard', compact('totalBarang', 'barangTersedia', 'totalUser', 'totalVoucher'));
    }
}