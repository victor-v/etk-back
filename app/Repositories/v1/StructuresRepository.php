<?php

namespace App\Repositories\v1;

use App\Models\v1\Structures;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StructuresRepository
 * @package App\Repositories\v1
 * @version October 25, 2018, 4:58 am UTC
 *
 * @method Structures findWithoutFail($id, $columns = ['*'])
 * @method Structures find($id, $columns = ['*'])
 * @method Structures first($columns = ['*'])
*/
class StructuresRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Structures::class;
    }
}
