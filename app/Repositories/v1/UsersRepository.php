<?php

namespace App\Repositories\v1;

use App\Models\Users;
use App\Repositories\BaseRepository;

class UsersRepository extends BaseRepository
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
        return Users::class;
    }
}
