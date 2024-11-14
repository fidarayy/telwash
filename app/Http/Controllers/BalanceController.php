<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class BalanceController extends Controller
{
    // Menampilkan halaman top-up
    public function index()
    {
        return view('user.topup'); // Pastikan file view bernama 'topup.blade.php'
    }

    // Memproses top-up saldo
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000', // Minimal top-up Rp10.000
            'payment_method' => 'required|in:qris,bank_transfer,e_wallet',
        ]);

        // Simpan data top-up ke tabel payments
        Payment::create([
            'user_id' => Auth::id(),
            'transaction_id' => null,
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'status' => 'pending',
            'payment_date' => now(),
        ]);

        // Update saldo user (simulasi)
        $user = Auth::user();
        $user->balance += $request->amount;
        $user->save();

        return redirect()->route('user.balance.index')->with('success', 'Top-up berhasil, saldo Anda telah diperbarui.');
    }
}
