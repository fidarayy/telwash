<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index()
    {        
        return view('admin.master_data.customers.index'); // Menampilkan view dengan data pelanggan
    }

    public function store(CustomerRequest $request)
    {
        try {
            Customer::create($request->validated());

            return redirect()->back()->with('success', 'Customer created successfuly.');
        } catch (\Exception $e) {
            session()->flash('showModal', true);
            return redirect()->back()->with('error', 'Customer created failed.');
        }
    }

    public function update(CustomerRequest $request, $id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->update($request->validated());

            return redirect()->back()->with('success', 'Customer updated successfuly.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Customer updated failed.');
        }
    }

    public function show()
    {
        $customers = Customer::latest()->get();

        return DataTables::of($customers)
            ->addColumn('edit', function ($row) {
                return '<button class="btn edit-btn" data-bs-toggle="modal" data-bs-target="#tambahPelangganModal" data-id="' . $row->customer_id . '" onclick="edit(this)"><i class="ti ti-ballpen"></i></button>';
            })
            ->rawColumns(['edit'])
            ->make(true);
    }

    public function edit($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        return response()->json([
            'id' => $customer->id,
            'name' => $customer->name,
            'phone_number' => $customer->phone_number,
        ]);
    }

    public function management() {
        $edit = true;        
        return view('admin.master_data.customers.management', compact("edit"));  // Mengarahkan ke halaman login
    }
}
