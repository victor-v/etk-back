<?php

namespace App\Models\v1;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Errors
 * @package App\Models\v1
 * @version October 22, 2018, 5:49 am UTC
 *
 * @property increments id_err
 * @property string desc_err_ru
 * @property string desc_err_uz
 * @property string code
 */
class Errors extends Model
{
    use SoftDeletes;

    public $table = 'errors';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_err',
        'desc_err_ru',
        'desc_err_uz',
        'code'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'desc_err_ru' => 'string',
        'desc_err_uz' => 'string',
        'code' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_err' => 'numeric',
        'desc_err_ru' => 'required string',
        'desc_err_uz' => 'required string',
        'code' => 'required string'
    ];

    
}
