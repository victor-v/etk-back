<?php

namespace App\Models\v1;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Constants
 * @package App\Models\v1
 * @version October 25, 2018, 4:56 am UTC
 *
 * @property integer group_const
 * @property string code_const
 * @property integer type_const
 * @property array value_const_ru
 * @property array value_const_uz
 * @property string commentconst
 */
class Constants extends Model
{
    use SoftDeletes;

    public $table = 'constants';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'group_const',
        'code_const',
        'type_const',
        'value_const_ru',
        'value_const_uz',
        'commentconst'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'group_const' => 'integer',
        'code_const' => 'string',
        'type_const' => 'integer',
        'commentconst' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'group_const' => 'integer',
        'code_const' => 'string',
        'type_const' => 'integer',
        'value_const_ru' => 'array',
        'value_const_uz' => 'array',
        'commentconst' => 'string'
    ];

    
}
