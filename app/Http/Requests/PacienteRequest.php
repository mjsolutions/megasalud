<?php

namespace MegaSalud\Http\Requests;

use MegaSalud\Http\Requests\Request;

class PacienteRequest extends Request
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
            'medico'    =>  'required',
            'foto'      =>  'mimes:jpeg,jpg,png,gif|size:3000',
            'telefono_a'=>  'integer',
        ];
    }
}
