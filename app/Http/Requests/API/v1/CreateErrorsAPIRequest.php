<?php

namespace App\Http\Requests\API\v1;

use App\Models\v1\Errors;
use InfyOm\Generator\Request\APIRequest;

class CreateErrorsAPIRequest extends APIRequest
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
        return Errors::$rules;
    }
}
