<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'nombres' => 'required|alpha|max:100|min:5',
            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique('users')->ignore($this->id)
            ],
            'pais' => [
                'required',
                Rule::in($this->getPaises())
            ],
            'apellidos' => 'required|alpha|max:100',
            'direccion' => 'required|max:180',
            'celular' => 'required|numeric|size:10'
        ];
    }

    private function getPaises()
    {
        return [
            'Argentina',
            'Bolivia (Plurinational State of)',
            'Brazil',
            'Chile',
            'Colombia',
            'Ecuador',
            'Falkland Islands (the) [Malvinas]',
            'French Guiana',
            'Guyana',
            'Paraguay',
            'Peru',
            'Suriname',
            'Uruguay',
            'Venezuela (Bolivarian Republic of)'
        ];
    }
}
