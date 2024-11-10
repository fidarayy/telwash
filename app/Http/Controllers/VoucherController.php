<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function create()
    {
        return view('vouchers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers,code',
            'discount' => 'required|numeric|min:0|max:100',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
        ]);

        Voucher::create($request->all());

        return redirect()->route('vouchers.create')->with('success', 'Voucher berhasil dibuat.');
    }
    public function index()
{
    $vouchers = Voucher::all(); // Mengambil semua data voucher
    return view('vouchers.index', compact('vouchers'));
}

}
