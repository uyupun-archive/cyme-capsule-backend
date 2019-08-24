<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class HelloController extends Controller
{
    public function hello()
    {
        return response('hello', 200);
    }
}
