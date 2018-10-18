<?php

namespace App\Repositories;

use App\Models\User;
use InfyOm\Generator\Common\BaseRepository;
use App\Repositories\BaseRepo;

class UserRepository extends BaseRepo
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'STRUCTURE_ID',
        'ACTIVE',
        'NAME',
        'LAST_NAME',
        'SECOND_NAME',
        'CREATED_BY',
        'email',
        'remember_token'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
