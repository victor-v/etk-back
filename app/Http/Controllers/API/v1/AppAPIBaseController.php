<?php

namespace App\Http\Controllers\API\v1;
use App\Http\Controllers\AppBaseController;


class AppAPIBaseController extends AppBaseController
{
    public function test($result, $message)
    {
        return 'hi';
    }

}
