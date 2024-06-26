<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVoucherRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'code' => 'required|min:4|unique:vouchers',
            'discount' => 'required|max:500',

        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'code.required' => 'The code field is required.',
            'code.min' => 'Code must min 4 characters',
            'code.unique' => 'This Voucher Code already have',
            'discount.max' => 'Discount amount max 500đ',

        ];
    }


    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            return response()->json($errors, 422);
        }

        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }
}
