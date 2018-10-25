<?php

namespace App\Repositories\v1;

use App\Models\v1\Logs;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LogsRepository
 * @package App\Repositories\v1
 * @version October 25, 2018, 4:57 am UTC
 *
 * @method Logs findWithoutFail($id, $columns = ['*'])
 * @method Logs find($id, $columns = ['*'])
 * @method Logs first($columns = ['*'])
*/
class LogsRepository extends BaseRepository
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
        return Logs::class;
    }
}
