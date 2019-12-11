<?php

namespace GuoGq\DingApiIsvYii2\api;
require_once(__DIR__ . "/../config.php");

use GuoGq\DingApiIsvYii2\util\Cache;
use GuoGq\DingApiIsvYii2\util\Log;

class ISVClass
{
    public static function getSuiteAccessToken()
    {
        $suiteTicket = Cache::getSuiteTicket();
        if (!$suiteTicket) {
            Log::e("ERROR: suiteTicket not cached,please check the callback url");
            return false;
        }
        $suiteAccessToken = ISVService::getSuiteAccessToken($suiteTicket);
        return $suiteAccessToken;
    }

    public static function getIsvCorpAccessToken($suiteAccessToken, $corpId, $permanetCode)
    {
        $key = "dingdingActive_" . $corpId;
        $corpAccessToken = ISVService::getIsvCorpAccessToken($suiteAccessToken, $corpId, $permanetCode);
        $status = Cache::getActiveStatus($key);
        if ($status <= 0 && $corpAccessToken != "") {
            ISVService::activeSuite($suiteAccessToken, $corpId, $permanetCode);
        }

        ISVService::getAuthInfo($suiteAccessToken, $corpId, $permanetCode);
        return $corpAccessToken;
    }

    public static function getCorpInfo($corpId)
    {
        $suiteAccessToken = ISVClass::getSuiteAccessToken();
        $corpInfo = ISVService::getCorpInfoByCorId($corpId);
        $corpAccessToken = ISVClass::getIsvCorpAccessToken($suiteAccessToken, $corpInfo['corp_id'], $corpInfo['permanent_code']);
        $corpInfo['corpAccessToken'] = $corpAccessToken;

        return $corpInfo;
    }
}

function check($res)
{
    if ($res->errcode != 0) {
        exit("Failed: " . json_encode($res));
    }
}
