<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;  // Set to true to authorize the request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,customer_id', // Customer exists in the customers table
            'user_id' => 'required|exists:users,user_id', // User exists in the users table
            'service_type' => 'required|in:Cuci Saja,Cuci Dan Setrika,Express', // Valid service types
            'weight' => 'required|numeric|min:1', // Weight should be numeric and at least 1
            'price' => 'required|numeric|min:0', // Price should be numeric and non-negative
            'payment_status' => 'required|in:Lunas,DP,Belum Dibayar', // Valid payment statuses
            // 'service_duration' => 'required|integer|min:1', // Service duration should be an integer and at least 1 day
            'received_at' => 'required|date', // Received date is required and must be a valid date
            'estimated_finish_at' => 'nullable|date|after_or_equal:received_at', // Estimated finish date should be after or equal to received_at
            'finished_at' => 'nullable|date|after_or_equal:estimated_finish_at', // Finished date should be after or equal to estimated_finish_at
            'status' => 'required|in:Diterima,Diproses,Selesai,Diambil', // Valid statuses
            'unit_type' => 'required|in:Satuan,Kilogram', // Valid unit types
            'payment_method' => 'required|in:Cash,Qris,E_wallet', // Valid payment methods
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages()
    {
        return [
            'customer_id.required' => 'Customer harus diisi.',
            'customer_id.exists' => 'Customer tidak ditemukan.',
            'user_id.required' => 'User harus diisi.',
            'user_id.exists' => 'User tidak ditemukan.',
            'service_type.required' => 'Jenis layanan harus diisi.',
            'service_type.in' => 'Jenis layanan harus salah satu dari: cuci saja, cuci + setrika, express.',
            'weight.required' => 'Berat harus diisi.',
            'weight.numeric' => 'Berat harus berupa angka.',
            'weight.min' => 'Berat minimal 1.',
            'price.required' => 'Harga harus diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh negatif.',
            'payment_status.required' => 'Status pembayaran harus diisi.',
            'payment_status.in' => 'Status pembayaran harus salah satu dari: lunas, belum lunas.',
            // 'service_duration.required' => 'Lama pengerjaan harus diisi.',
            // 'service_duration.integer' => 'Lama pengerjaan harus berupa angka.',
            // 'service_duration.min' => 'Lama pengerjaan minimal 1 hari.',
            'received_at.required' => 'Tanggal penerimaan harus diisi.',
            'received_at.date' => 'Tanggal penerimaan tidak valid.',
            'estimated_finish_at.date' => 'Tanggal estimasi selesai tidak valid.',
            'estimated_finish_at.after_or_equal' => 'Tanggal estimasi selesai harus setelah atau sama dengan tanggal penerimaan.',
            'finished_at.date' => 'Tanggal selesai tidak valid.',
            'finished_at.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal estimasi selesai.',
            'status.required' => 'Status harus diisi.',
            'status.in' => 'Status harus salah satu dari: diterima, diproses, selesai, diambil.',
            'unit_type.required' => 'Jenis satuan harus diisi.',
            'unit_type.in' => 'Jenis satuan harus salah satu dari: satuan, kilogram.',
            'payment_method.required' => 'Metode pembayaran harus diisi.',
            'payment_method.in' => 'Metode pembayaran harus salah satu dari: cash, qris, e_wallet.',
        ];
    }

    protected function prepareForValidation()
    {        
        $this->merge([
            'price' => floatval(str_replace(['Rp. ', '.'], '', $this->price))
        ]);
    }
    

    protected function failedValidation(Validator $validator)
    {
        // Flash a flag to reopen the modal
        session()->flash('showModal', true);
        session()->flash('previousId', $this->route('id')); // Assuming 'id' is in the route
        session()->flash('error', 'Transaction updated failed');

        throw new ValidationException($validator);
    }
}
