<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15|unique:customers,phone_number' . ($this->route('id') ? ",{$this->route('id')},customer_id" : ''),
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama pelanggan harus diisi.',
            'name.string' => 'Nama pelanggan harus berupa teks.',
            'name.max' => 'Nama pelanggan tidak boleh lebih dari 255 karakter.',
            'phone_number.required' => 'Nomor telepon harus diisi.',
            'phone_number.string' => 'Nomor telepon harus berupa teks.',
            'phone_number.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',
            'phone_number.unique' => 'Nomor telepon sudah terdaftar.',
        ];
    }

    /**
     * Prepare data for validation.
     */
    protected function prepareForValidation()
    {
        // Add any transformations here if needed
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        // Flash a flag to reopen the modal
        session()->flash('showModal', true);

        // Add conditional ID if available
        if ($this->route('id')) {
            session()->flash('previousId', $this->route('id'));
        } else {            
            session()->flash('error', 'Customer created failed.');
        }        
        

        // Throw the validation exception
        throw new ValidationException($validator);
    }
}
