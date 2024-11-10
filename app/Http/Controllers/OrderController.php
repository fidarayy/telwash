<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create() {
        return view('orders.create'); // Form untuk transaksi baru
    }
    public function history()
{
    $orders = Order::all(); // Sesuaikan query dengan kebutuhan
    return view('orders.history', compact('orders')); // Pastikan view `orders.history` tersedia
}
public function index(Request $request)
{
    $search = $request->input('search');
    $status = $request->input('status');

    $orders = Order::with('customer')
        ->when($search, function ($query, $search) {
            return $query->where('transaction_id', $search);
        })
        ->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->get();

    return view('dashboard', compact('orders'));
}

    
}
