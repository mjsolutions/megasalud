<?php

namespace MegaSalud\Http\Requests;

use MegaSalud\Http\Requests\Request;

class ProductoSucursalRequest extends Request
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
            'existencia'    =>  'required|min:0',
            'producto_id'   =>  'required|min:0'
        ];
    }
}
