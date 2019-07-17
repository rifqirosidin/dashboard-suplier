<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluasi extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'metode_pembayaran.*' => 'required|min:1|max:5',
            'kualitas.*' => 'required|min:1|max:5',
            'waktu_pengiriman.*' => 'required|min:1|max:5',
            'harga_barang.*' => 'required|min:1|max:5',
            'total_nilai' => 'required|min:1|max:5',
            'suplier_id.*' => 'required|min:1|max:5',
        ];
    }
}
