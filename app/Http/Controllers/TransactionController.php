<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $transactions = Transaction::select(
            'transactions.*',
            'customers.name as nama_pelanggan',       
            'customers.phone_number as no_telepon'    
        )
            ->join('customers', 'transactions.customer_id', '=', 'customers.customer_id')
            ->join('users', 'transactions.user_id', '=', 'users.user_id')
            ->get();

        return DataTables::of($transactions)
            ->addColumn('edit', function ($row) {
                return '<a href="/transactions/edit/' . $row->transaction_id . '" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->rawColumns(['edit'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

// use Illuminate\Http\Request;
// use App\Models\Transaction; // Tambahkan ini

// class TransactionController extends Controller
// {
//     // Method untuk menampilkan daftar transaksi
//     public function index(Request $request)
// {
//     $search = $request->input('search');
//     $status = $request->input('status');

//     // Ambil data ringkasan pesanan
//     $pesananDiterima = Transaction::where('status', 'diterima')->count();
//     $pesananDiproses = Transaction::where('status', 'diproses')->count();
//     $pesananSelesai = Transaction::where('status', 'selesai')->count();
//     $pesananPerluDikirim = Transaction::whereDate('finished_at', now()->toDateString())->where('status', 'selesai')->count();

//     // Filter transaksi
//     $transactions = Transaction::with('customer')
//     ->when($request->input('search'), function ($query, $search) {
//         return $query->where('transaction_id', 'like', "%$search%");
//     })
//     ->when($request->input('status'), function ($query, $status) {
//         return $query->where('status', $status);
//     })
//     ->get();


//     return view('dashboard', compact(
//         'pesananDiterima',
//         'pesananDiproses',
//         'pesananSelesai',
//         'pesananPerluDikirim',
//         'transactions'
//     ));
// }

    

//     // Method untuk membuat transaksi baru
//     public function create()
//     {
//         return view('transactions.create');  // Pastikan file `transactions/create.blade.php` ada
//     }

//     // Method untuk menampilkan history transaksi
//     public function history()
//     {
//         // Logika untuk mendapatkan data history transaksi
//         return view('transactions.history');  // Pastikan file `transactions/history.blade.php` ada
//     }
// }
