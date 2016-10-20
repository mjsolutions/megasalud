<?php

namespace MegaSalud\Http\Requests;

use MegaSalud\Http\Requests\Request;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//Autorizar para utilizar
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
                    'tipo_usuario' => 'required',
                    'cp' => 'numeric',
                    'password' => 'confirmed|required',
                    'email' => 'unique:users,email,',
                    'curp' => 'regex:/^([a-z]{4})([0-9]{6})([a-z]{6})([0-9]{2})$/i',
                    'sucursal' => 'required_if:tipo_usuario,Administrador de sucursal'
                ];
            }
            case 'PUT':
            {
                return [
                    'nombre' => 'required',
                    'email' => 'unique:users,email,'.$this->segment(3),
                    'tipo_usuario' => 'required',
                ];
            }
        }
    }

    /**
     * 'email' => 'unique:users,email|required',
            'password' => 'confirmed|required'
    **/
}
