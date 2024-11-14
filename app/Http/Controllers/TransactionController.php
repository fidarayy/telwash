<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; // Tambahkan ini
use App\Models\Customer; // Tambahkan ini
use Illuminate\Support\Facades\Auth;
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
            'user_id' => Auth::id(),
            'service_type' => $request->service_type,
            'status' => 'diterima',
            'payment_status' => 'pending',
            'unit_type' => 'kilogram', // Set langsung ke kilogram
            'received_at' => now(),
            'service_duration' => 0, // Default value   
            'pickup_at' => now(), // Tanggal kirim otomatis sesuai tanggal diterima
        ]);        
        

        // Redirect ke halaman pembayaran
        return redirect()->route('user.payment', ['transaction' => $transaction->transaction_id])
            ->with('success', 'Pesanan berhasil dibuat, lanjutkan ke pembayaran.');
    }
    public function acceptOrder(Request $request, Transaction $transaction)
{
    // Update status dan tanggal terkait
    $transaction->update([
        'status' => 'diproses', // Status diperbarui menjadi 'diproses'
        'received_at' => now(), // Tanggal diterima (waktu saat ini)
        'pickup_at' => now(),   // Tanggal kirim (waktu saat ini)
    ]);

    // Hitung service duration berdasarkan jenis layanan
    $serviceDuration = match ($transaction->service_type) {
        'cuci_saja' => 2,       // 2 hari
        'cuci_setrika' => 3,    // 3 hari
        'express' => 1,         // 1 hari
        default => 0,           // Default jika tidak sesuai
    };

    // Update service_duration di database
    $transaction->update([
        'service_duration' => $serviceDuration,
    ]);

    // Redirect ke halaman pickup dengan pesan sukses
    return redirect()->route('pickup.index')->with('success', 'Pesanan berhasil diterima dan diproses.');
}
public function showInvoice($id)
{
    // Ambil data transaksi berdasarkan ID
    $transaction = Transaction::with('customer')->findOrFail($id);

    return view('user.invoice', compact('transaction'));
}


}

