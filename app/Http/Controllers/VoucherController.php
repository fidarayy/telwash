<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoucherRequest;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Facades\DataTables;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::all(); // Mengambil semua data voucher
        return view('admin.master_data.voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master_data.voucher.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(VoucherRequest $request)
    {
        try {
            // Validasi dan simpan voucher            
            Voucher::create($request->validated());

            return redirect()->route('admin.master_data.voucher.index')->with('success', 'Voucher created successfully');
        } catch (\Exception $e) {
            // Jika terjadi error, tampilkan pesan error
            return redirect()->back()->with('error', 'Voucher created failed')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $vouchers = Voucher::latest()->get(); // You can apply filters here as needed

        return DataTables::of($vouchers)
            ->addColumn('actions', function ($row) {
                // Edit Button
                $editButton = '<button class="btn edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' . $row->voucher_id . '" onclick="edit(this)"><i class="ti ti-ballpen"></i></button>';

                // Delete Button
                $deleteButton = '
    <form action="' . route('admin.master_data.voucher.destroy', $row->voucher_id) . '" method="POST" style="display:inline;">
        ' . csrf_field() . '
        ' . method_field('DELETE') . '
        <button type="submit" class="btn btn-danger btn-sm delete-btn">
            <i class="ti ti-trash"></i> 
        </button>
    </form>
';

                // Active/Non-Active Toggle Button
                $statusButton = $row->status
                    ? '<a href="' . route('admin.master_data.voucher.status', $row->voucher_id) . '" class="btn btn-success btn-sm status-btn">
        <i class="ti ti-check"></i> 
        </a>'
                    : '<a href="' . route('admin.master_data.voucher.status', $row->voucher_id) . '" class="btn btn-secondary btn-sm status-btn">
        <i class="ti ti-x"></i> 
        </a>';

                // Return all the buttons
                return $editButton . ' ' . $deleteButton . ' ' . $statusButton;
            })
            ->editColumn('status', function ($row) {
                return $row->status ? "Aktif" : "Non Aktif";
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $voucher = Voucher::find($id);

            if (!$voucher) {
                return response()->json(['message' => 'Voucher not found'], 404);
            }

            return response()->json([
                'voucher_id' => $voucher->voucher_id,
                'code' => $voucher->code,
                'discount' => $voucher->discount,
                'min_transaction' => $voucher->min_transaction,
                'max_discount' => $voucher->max_discount,
                'usage_limit' => $voucher->usage_limit,
                'valid_from' => Carbon::parse($voucher->valid_from)->format('Y-m-d\TH:i'),
                'valid_until' => $voucher->valid_until ? Carbon::parse($voucher->valid_until)->format('Y-m-d\TH:i') : null,
                'product' => $voucher->product,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching voucher data', 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(VoucherRequest $request, $id)
    {
        try {
            $voucher = Voucher::findOrFail($id);
            $voucher->update($request->validated());

            return redirect()->route('admin.master_data.voucher.index')->with('success', 'Voucher updated succesfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Voucher updated failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $voucher = Voucher::find($id);

            if (!$voucher) {
                session()->flash('error', 'Voucher not found');
                return redirect()->back(); // Adjust the route as needed
            }

            $voucher->delete();

            DB::commit();

            session()->flash('success', 'Voucher deleted successfully');
            return redirect()->back(); // Adjust the route as needed
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error deleting voucher: ' . $e->getMessage());
            return redirect()->back(); // Adjust the route as needed
        }
    }


    public function status(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            $voucher = Voucher::find($id);

            if (!$voucher) {
                session()->flash('error', 'Voucher not found');
                return redirect()->back(); // Adjust the route as needed
            }

            // Toggle the status
            $voucher->status = !$voucher->status;
            $voucher->save();

            DB::commit();

            session()->flash('success', 'Voucher status updated successfully');
            return redirect()->back(); // Adjust the route as needed
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error updating voucher status: ' . $e->getMessage());
            return redirect()->back(); // Adjust the route as needed
        }
    }
}
