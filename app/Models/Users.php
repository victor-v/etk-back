<?php

namespace App\Models;

use Eloquent as Model;


class Users extends Model
{

    public $table = 'users';

    public $timestamps = false;

    public $primaryKey = 'id_user';

    public $fillable = [
        'active_user',
        'user_type',
        'user_tin_user',
        'user_pin_user',
        'user_tin_company',
        'user_soato_company',
        'user_mobile',
        'user_home_tel',
        'user_oked_user',
        'token_user',
        'visible_data',
        'company_right',
        'ML_right',
        'su_right',
        'ws_right',
        'remember_token',
        'password',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'active_user' => 'boolean',
        'user_type' => 'integer',
        'user_tin_user' => 'string',
        'user_pin_user' => 'string',
        'user_tin_company' => 'string',
        'user_soato_company' => 'string',
        'user_mobile' => 'string',
        'user_home_tel' => 'string',
        'user_oked_user' => 'string',
        'token_user' => 'string',
        'visible_data' => 'boolean',
        'company_right' => 'integer',
        'ML_right' => 'integer',
        'su_right' => 'integer',
        'ws_right' => 'integer',
        'remember_token' => 'string',
    ];
    protected $hidden = ['password'];
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
