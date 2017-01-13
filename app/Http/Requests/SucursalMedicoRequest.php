<?php

namespace MegaSalud\Http\Requests;

use MegaSalud\Http\Requests\Request;

class SucursalMedicoRequest extends Request
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
        switch($this->method()) {
            case 'POST':
            {
                return [
                    'nombre' => 'required',
                    'cp' => 'numeric',
                    'telefono_a' => 'numeric',
                    'telefono_b' => 'numeric|different:telefono_a',
                    'password' => 'confirmed|required',
                    'email' => 'unique:users,email,',
                    'curp' => 'regex:/^([a-z]{4})([0-9]{6})([a-z]{6})([0-9]{2})$/i'
                ];
            }
            case 'PUT':
            {
                return [
                    'nombre' => 'required',
                    'email' => 'unique:users,email,'.$this->segment(3),
                    'cp' => 'numeric',
                    'telefono_a' => 'numeric',
                    'telefono_b' => 'numeric|different:telefono_a',
                    'curp' => 'regex:/^([a-z]{4})([0-9]{6})([a-z]{6})([0-9]{2})$/i'
                ];
            }
        }
    }
}
