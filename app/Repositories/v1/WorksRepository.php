<?php

namespace App\Repositories\v1;

use App\Models\v1\Errors;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ErrorsRepository
 * @package App\Repositories\v1
 * @version October 22, 2018, 5:49 am UTC
 *
 * @method Errors findWithoutFail($id, $columns = ['*'])
 * @method Errors find($id, $columns = ['*'])
 * @method Errors first($columns = ['*'])
*/
class WorksRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_err',
        'desc_err_ru',
        'desc_err_uz',
        'code'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Errors::class;
    }
}
