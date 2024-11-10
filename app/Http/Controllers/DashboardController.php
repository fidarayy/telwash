<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Model untuk pesanan
use App\Models\Customer;
use App\Models\Voucher;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data untuk ringkasan pesanan
        $pesananDiterima = Order::where('status', 'diterima')->count();
        $pesananDiproses = Order::where('status', 'diproses')->count();
        $pesananSelesai = Order::where('status', 'selesai')->count();
        $pesananPerluDikirim = Order::whereDate('finished_at', now()->toDateString())->where('status', 'selesai')->count();
    
        // Ambil data daftar pesanan
        $orders = Order::with('customer')->get();
    
        return view('dashboard', compact('pesananDiterima', 'pesananDiproses', 'pesananSelesai', 'pesananPerluDikirim', 'orders'));
    }
    
}
