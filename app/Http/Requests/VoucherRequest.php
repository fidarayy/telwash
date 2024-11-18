<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class VoucherRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Jika memerlukan otorisasi, sesuaikan di sini
    }

    public function rules()
{
    $id = $this->route('id'); // Get the 'id' parameter from the route
    
    return [
        'code' => 'required|unique:vouchers,code,' . ($id ? $id : 'NULL') . ',voucher_id',
        'discount' => 'required|numeric|min:0|max:100',
        'min_transaction' => 'required|numeric',
        'max_discount' => 'required|numeric',
        'usage_limit' => 'required|integer|min:1',
        'valid_from' => 'required|date|after_or_equal:' . now()->toDateString(),
        'valid_until' => 'nullable|date|after_or_equal:valid_from|after_or_equal:' . now()->toDateString(),
    ];
}


    public function messages()
    {
        return [
            'code.required' => 'Kode voucher wajib diisi.',
            'code.unique' => 'Kode voucher sudah terpakai.',
            'discount.required' => 'Diskon wajib diisi.',
            'discount.numeric' => 'Diskon harus berupa angka.',
            'discount.min' => 'Diskon tidak boleh kurang dari 0.',
            'discount.max' => 'Diskon tidak boleh lebih dari 100%.',
            'min_transaction.required' => 'Transaksi minimum wajib diisi.',
            'min_transaction.numeric' => 'Transaksi minimum harus berupa angka.',
            'max_discount.required' => 'Maksimal diskon wajib diisi.',
            'max_discount.numeric' => 'Maksimal diskon harus berupa angka.',
            'usage_limit.required' => 'Batas penggunaan wajib diisi.',
            'usage_limit.integer' => 'Batas penggunaan harus berupa angka bulat.',
            'usage_limit.min' => 'Batas penggunaan tidak boleh kurang dari 1.',
            'valid_from.required' => 'Tanggal berlaku mulai wajib diisi.',
            'valid_from.date' => 'Tanggal berlaku mulai tidak valid.',
            'valid_from.after_or_equal' => 'Tanggal berlaku mulai tidak boleh kurang dari hari ini.',
            'valid_until.date' => 'Tanggal berlaku hingga tidak valid.',
            'valid_until.after_or_equal' => 'Tanggal berlaku hingga harus setelah atau sama dengan tanggal berlaku mulai.',
            'valid_until.after_or_equal_today' => 'Tanggal berlaku hingga tidak boleh kurang dari hari ini.',
        ];        
    }

    protected function failedValidation(Validator $validator)
{        

    // Flash a flag to reopen the modal
    session()->flash('showModal', true);

    // Pass the previous 'id' if it's available (for edit)
    if ($this->id) {
        session()->flash('previousId', $this->route('id'));
        session()->flash('error', 'Voucher updated failed.');
    } else {        
        session()->flash('error', 'Voucher created failed.');
    }

    throw new ValidationException($validator);
}

}
