<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class PaymentController extends Controller
{
    // Menampilkan halaman pembayaran
    public function show($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

        return view('user.payment', compact('transaction'));
    }

    // Proses pembayaran
    public function process(Request $request, $transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

        // Validasi input (misalnya voucher)
        $request->validate([
            'payment_method' => 'required|in:qris,bank_transfer,e_wallet',
        ]);

        // Update status transaksi
        $transaction->update([
            'payment_status' => 'success',
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Pembayaran berhasil!');
    }
}
