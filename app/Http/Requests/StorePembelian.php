<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePembelian extends FormRequest
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
            'tgl_pembelian' => 'required|date',
            'no_sop' => 'required',
            'suplier_id' => 'required|numeric',
            'nama_barang' => 'required',
            'jumlah' => 'required|numeric',
            'satuan' => 'required|string',
            'harga' => 'required|numeric'
        ];
    }
}
