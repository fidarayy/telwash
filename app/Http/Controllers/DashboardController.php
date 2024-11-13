<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request; // Tambahkan ini
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index(Request $request)
{
    // Ambil parameter pencarian dan status
    $search = $request->input('search');
    $status = $request->input('status');

    // Ambil data untuk ringkasan pesanan
    $pesananDiterima = Transaction::where('status', 'diterima')->count();
    $pesananDiproses = Transaction::where('status', 'diproses')->count();
    $pesananSelesai = Transaction::where('status', 'selesai')->count();
    $pesananPerluDikirim = Transaction::whereDate('finished_at', now()->toDateString())
        ->where('status', 'selesai')
        ->count();

    // Filter transaksi berdasarkan parameter pencarian dan status
    $transactions = Transaction::with('customer')
        ->when($search, function ($query, $search) {
            return $query->where('transaction_id', 'like', "%$search%");
        })
        ->when($status, function ($query, $status) {
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

public function userDashboard()
{
    $userId = Auth::id(); // Mendapatkan ID user yang sedang login

    // Hitung pesanan aktif
    $activeOrders = Transaction::where('user_id', $userId)
        ->where('status', '!=', 'selesai')
        ->count();

    // Hitung pesanan selesai
    $completedOrders = Transaction::where('user_id', $userId)
        ->where('status', 'selesai')
        ->count();

    // Ambil saldo pengguna
    $balance = Auth::user()->balance ?? 0; // Pastikan kolom balance ada di tabel users

    // Ambil riwayat transaksi
    $orders = Transaction::where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get();

    // Kirim data ke view 'user.dashboard'
    return view('user.dashboard', compact('activeOrders', 'completedOrders', 'balance', 'orders'));
}

}
