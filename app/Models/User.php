<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="User",
 *      required={""},
 *      @SWG\Property(
 *          property="USER_ID",
 *          description="USER_ID",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="STRUCTURE_ID",
 *          description="STRUCTURE_ID",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="ACTIVE",
 *          description="ACTIVE",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="NAME",
 *          description="NAME",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="LAST_NAME",
 *          description="LAST_NAME",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="LOGIN",
 *          description="LOGIN",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="CREATED_BY",
 *          description="CREATED_BY",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="remember_token",
 *          description="remember_token",
 *          type="string"
 *      )
 * )
 */
class User extends Model
{

    public $table = 'users';

    public $timestamps = false;

    public $primaryKey = 'user_id';

    public $fillable = [
        'STRUCTURE_ID',
        'ACTIVE',
        'NAME',
        'LAST_NAME',
        'SECOND_NAME',
        'LOGIN',
        'password',
        'LAST_LOGIN',
        'DATE_REGISTER',
        'TIMESTAMP_X',
        'CREATED_BY',
        'email',
        'remember_token',
        'IS_ADMIN',
        'AUTH_TYPE',
        "TIN",
        "PIN",
        "ADDRESS",
        "COMMENT",
        'api_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'USER_ID' => 'integer',
        'STRUCTURE_ID' => 'integer',
        'ACTIVE' => 'boolean',
        'NAME' => 'string',
        'LAST_NAME' => 'string',
        'SECOND_NAME' => 'string',
        'LOGIN' => 'string',
        'password' => 'string',
        'CREATED_BY' => 'integer',
        'email' => 'string',
        'remember_token' => 'string',
        'IS_ADMIN' => 'boolean',
        'AUTH_TYPE' => 'string',
        "TIN" => 'string',
        "PIN" => 'string',
        "ADDRESS" => 'string',
        "COMMENT" => 'text',
        'api_token' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
