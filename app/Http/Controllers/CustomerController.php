<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all(); // Mengambil semua data pelanggan
        return view('customers.index', compact('customers')); // Menampilkan view dengan data pelanggan
    }
}
