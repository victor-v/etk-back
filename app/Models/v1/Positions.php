<?php

namespace App\Models\v1;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Positions
 * @package App\Models\v1
 * @version October 25, 2018, 4:58 am UTC
 *
 */
class Positions extends Model
{
    use SoftDeletes;

    public $table = 'positions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
