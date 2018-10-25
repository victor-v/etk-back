<?php

namespace App\Repositories\v1;

use App\Models\v1\Positions;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PositionsRepository
 * @package App\Repositories\v1
 * @version October 25, 2018, 4:58 am UTC
 *
 * @method Positions findWithoutFail($id, $columns = ['*'])
 * @method Positions find($id, $columns = ['*'])
 * @method Positions first($columns = ['*'])
*/
class PositionsRepository extends BaseRepository
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
        return Positions::class;
    }
}
