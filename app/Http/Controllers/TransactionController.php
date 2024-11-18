<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.master_data.transaction.index");
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
        DB::beginTransaction();

        try {
            // Validation is handled by TransactionRequest, so this proceeds directly
            $request->validate([
                'customer_id' => 'required|exists:customers,customer_id', // Customer exists in the customers table
                'user_id' => 'required|exists:users,user_id', // User exists in the users table
                'service_type' => 'required|in:Cuci Saja,Cuci Dan Setrika,Express', // Valid service types
                'weight' => 'required|numeric|min:1', // Weight should be numeric and at least 1
                'price' => 'required|numeric|min:0', // Price should be numeric and non-negative
                'payment_status' => 'required|in:Lunas,DP,Belum Dibayar', // Valid payment statuses
                'service_duration' => 'required|integer|min:1', // Service duration should be an integer and at least 1 day
                'received_at' => 'required|date', // Received date is required and must be a valid date
                'estimated_finish_at' => 'nullable|date|after_or_equal:received_at', // Estimated finish date should be after or equal to received_at
                'finished_at' => 'nullable|date|after_or_equal:estimated_finish_at', // Finished date should be after or equal to estimated_finish_at
                'status' => 'required|in:Diterima,Diproses,Selesai,Diambil', // Valid statuses
                'unit_type' => 'required|in:satuan,kilogram', // Valid unit types
                'payment_method' => 'required|in:Cash,Qris,E_wallet', // Valid payment methods
            ]);

            // dd($request->all());        
            // $request->all();

            DB::commit();

            return redirect()->back()->with('success', 'Transaction successfully created.');
        } catch (Exception $e) {

            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Transaction creation failed: ' . $e->getMessage()]);
        }
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
            ->latest()
            ->get();

        return DataTables::of($transactions)
            ->addColumn('edit', function ($row) {
                return '<button class="btn edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' . $row->transaction_id . '" onclick="edit(this)"><i class="ti ti-ballpen"></i></button>';
            })
            ->editColumn('price', function($row) {
                return "Rp. " . number_format($row->price, 0, '', '.');; 
            })
            ->rawColumns(['edit'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json([
            'transaction_id' => $transaction->transaction_id,
            'customer_id' => $transaction->customer_id,
            'phone_number' => $transaction->customer->phone_number,
            'weight' => $transaction->weight,
            'price' => number_format($transaction->price, 0, '', '.'),
            'finished_at' => Carbon::parse($transaction->finished_at)->format('Y-m-d\TH:i'),
            'received_at' => Carbon::parse($transaction->received_at)->format('Y-m-d\TH:i'),
            'service_type' => $transaction->service_type,
            'payment_status' => $transaction->payment_status,
            'status' => $transaction->status,
            'unit_type' => $transaction->unit_type,
            'payment_method' => $transaction->payment_method
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, $id)
    {
        try {                     
            $transaction = Transaction::findOrFail($id);
            $request['user_id'] = 1;
            $transaction->update($request->all());

            return redirect()->back()->with('success', 'Transaction successfully updated.');
        } catch (Exception $e) {
            session()->flash('showModal', true);
            session()->flash('error', 'Transaction updated failed');
            return redirect()->back();
        }
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
