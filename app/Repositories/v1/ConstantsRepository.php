<?php

namespace App\Repositories\v1;

use App\Models\v1\Constants;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ConstantsRepository
 * @package App\Repositories\v1
 * @version October 25, 2018, 4:56 am UTC
 *
 * @method Constants findWithoutFail($id, $columns = ['*'])
 * @method Constants find($id, $columns = ['*'])
 * @method Constants first($columns = ['*'])
*/
class ConstantsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'group_const',
        'code_const',
        'type_const',
        'value_const_ru',
        'value_const_uz',
        'commentconst'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Constants::class;
    }
}
