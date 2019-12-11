<?php

namespace GuoGq\DingApiIsvYii2\api;

use GuoGq\DingApiIsvYii2\util\Http;

class User
{
    public static function getUserInfo($accessToken, $code)
    {
        $response = Http::get("/user/getuserinfo",
            array("access_token" => $accessToken, "code" => $code));
        return json_encode($response);
    }


    public static function simplelist($accessToken, $deptId)
    {
        $response = Http::get("/user/simplelist",
            array("access_token" => $accessToken, "department_id" => $deptId));
        return $response->userlist;

    }
}
