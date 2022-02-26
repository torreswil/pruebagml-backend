<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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

        $rules = [
            'nombres' => 'required|regex:/^[\pL\s\-\.]+$/u|max:100|min:5',
            'cedula' => [
                'required',
                'numeric'
            ],
            'email' => [
                'required',
                'email:rfc,dns'
            ],
            'pais' => [
                'required',
                Rule::in($this->getPaises())
            ],
            'apellidos' => 'required|regex:/^[\pL\s\-\.]+$/u|max:100',
            'direccion' => 'required|max:180',
            'celular' => 'required|numeric|digits:10'
        ];

        if($this->id){
            $rules['cedula'][] = Rule::unique('users')->ignore($this->id);
            $rules['email'][] = Rule::unique('users')->ignore($this->id);

            return $rules;
        }

        $rules['cedula'] = Rule::unique('users');
        $rules['email'] = Rule::unique('users');
        $rules['password'] = 'required';

        return $rules;
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
