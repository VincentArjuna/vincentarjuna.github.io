<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertPelangganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama' => 'required|string',
            'tanggal_lahir' => 'date',
            'alamat' => 'required|string',
            'member' => 'required|boolean',
            'no_id' => 'nullable|string',
            'jenis_id' => 'nullable|string',
            'telephone' => 'nullable|string',
            'email' => 'nullable|string',
        ];
    }
}
