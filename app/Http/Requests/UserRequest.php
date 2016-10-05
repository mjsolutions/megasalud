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
        return [
            'nombre' => 'required',
            'email' => 'unique:users,email|required',
            'password' => 'confirmed|required'

        ];
    }
}
