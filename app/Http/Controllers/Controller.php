<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function queryParams($query){
        $params = explode(",", $query);
        $condition = (!empty($params[1])) ? $params[1] : '=';
        $value = $params[0];

        return ["condition" => $condition, "value" => $value];
    }
}
