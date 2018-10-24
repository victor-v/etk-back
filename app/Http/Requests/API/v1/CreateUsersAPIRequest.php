<?php

namespace App\Http\Requests\API\v1;

use App\Models\Users;
use App\Http\Requests\API\APIRequest;

class CreateUsersAPIRequest extends APIRequest
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
        return Users::$rules;
    }
}
