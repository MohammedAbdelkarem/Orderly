<?php

namespace App\Http\Services;

use App\Http\Traits\ModelHelper;
use App\Http\Traits\ApiResponder;
use App\Http\Traits\Utility;

class BaseService
{
    use ApiResponder, ModelHelper, Utility;

}
