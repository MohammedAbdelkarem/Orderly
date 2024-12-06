<?php

namespace App\Http\Requests;

use App\Http\Traits\ApiResponder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseApiRequest extends FormRequest
{
    use ApiResponder;

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'messages' => $validator->errors()->all(),
                'status' => 422 ,
                'data' => null
            ]
            , 422
        ));
    }

}
