<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; // Tambahkan ini

class TransactionController extends Controller
{
    // Method untuk menampilkan daftar transaksi
    public function index(Request $request)
{
    $search = $request->input('search');
    $status = $request->input('status');

    // Ambil data ringkasan pesanan
    $pesananDiterima = Transaction::where('status', 'diterima')->count();
    $pesananDiproses = Transaction::where('status', 'diproses')->count();
    $pesananSelesai = Transaction::where('status', 'selesai')->count();
    $pesananPerluDikirim = Transaction::whereDate('finished_at', now()->toDateString())->where('status', 'selesai')->count();

    // Filter transaksi
    $transactions = Transaction::with('customer')
    ->when($request->input('search'), function ($query, $search) {
        return $query->where('transaction_id', 'like', "%$search%");
    })
    ->when($request->input('status'), function ($query, $status) {
        return $query->where('status', $status);
    })
    ->get();


    return view('dashboard', compact(
        'pesananDiterima',
        'pesananDiproses',
        'pesananSelesai',
        'pesananPerluDikirim',
        'transactions'
    ));
}

    

    // Method untuk membuat transaksi baru
    public function create()
{
    return view('user.createorder'); // Sesuaikan path untuk user
}

public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'service_type' => 'required|in:cuci_saja,cuci_setrika,express',
        ]);

        // Cari atau buat pelanggan baru
        $customer = Customer::firstOrCreate(
            ['phone_number' => $request->phone_number],
            ['name' => $request->customer_name]
        );

        // Buat transaksi baru
        $transaction = Transaction::create([
            'customer_id' => $customer->customer_id,
            'user_id' => Auth::id(), // ID user yang login
            'service_type' => $request->service_type,
            'status' => 'diterima', // Status awal
            'payment_status' => 'pending', // Belum dibayar
            'received_at' => now(),
        ]);

        // Redirect ke halaman pembayaran
        return redirect()->route('user.payment', ['transaction' => $transaction->transaction_id])
            ->with('success', 'Pesanan berhasil dibuat, lanjutkan ke pembayaran.');
    }
}

