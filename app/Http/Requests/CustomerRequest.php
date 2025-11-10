<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // gate later if needed
    }

    public function rules(): array
    {
        $id = $this->route('customer')?->id;

        return [
            'name'   => ['required','string','max:120'],
            'email'  => [
                'required','email','max:190',
                Rule::unique('customers','email')->ignore($id)
            ],
            'phone'  => ['required','string','max:40'],
            'address'=> ['nullable','string','max:255'],
        ];
    }
}
