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
        return view('transactions.create');  // Pastikan file `transactions/create.blade.php` ada
    }

    // Method untuk menampilkan history transaksi
    public function history()
    {
        // Logika untuk mendapatkan data history transaksi
        return view('transactions.history');  // Pastikan file `transactions/history.blade.php` ada
    }
}
