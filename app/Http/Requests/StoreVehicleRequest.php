<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'plate_number' => ['required','string','max:50','unique:vehicles,plate_number'],
            'make'         => ['required','string','max:100'],
            'model'        => ['required','string','max:100'],
            'year'         => ['required','integer','between:1980,'.(now()->year+1)],
            'color'        => ['nullable','string','max:50'],
            'daily_rate'   => ['required','numeric','min:0'],
            'status'       => ['required','in:available,maintenance,rented'],
            //
        ];
    }
}
