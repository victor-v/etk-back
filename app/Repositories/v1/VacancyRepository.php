<?php

namespace App\Repositories\v1;

use App\Models\v1\Vacancy;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class VacancyRepository
 * @package App\Repositories\v1
 * @version October 25, 2018, 4:58 am UTC
 *
 * @method Vacancy findWithoutFail($id, $columns = ['*'])
 * @method Vacancy find($id, $columns = ['*'])
 * @method Vacancy first($columns = ['*'])
*/
class VacancyRepository extends BaseRepository
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
        return Vacancy::class;
    }
}
