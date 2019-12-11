<?php

namespace GuoGq\DingApiIsvYii2\util;

class Cache
{
    public static function setSuiteTicket($ticket)
    {
        $memcache = self::getMemcache();
        $memcache->set("suite_ticket", $ticket);
    }

    public static function getSuiteTicket()
    {
        $memcache = self::getMemcache();
        return $memcache->get("suite_ticket");
    }

    public static function setJsTicket($key, $ticket)
    {
        $memcache = self::getMemcache();
        $memcache->set($key, $ticket, 0, time() + 7000); // js ticket有效期为7200秒，这里设置为7000秒
    }

    public static function getJsTicket($key)
    {
        $memcache = self::getMemcache();
        return $memcache->get($key);
    }

    public static function setSuiteAccessToken($accessToken)
    {
        $memcache = self::getMemcache();
        $memcache->set("suite_access_token", $accessToken, 0, time() + 7000); // suite access token有效期为7200秒，这里设置为7000秒
    }

    public static function  getSuiteAccessToken()
    {
        $memcache = self::getMemcache();
        return $memcache->get("suite_access_token");
    }

    public static function setIsvCorpAccessToken($key, $accessToken)
    {
        $memcache = self::getMemcache();
        $memcache->set($key, $accessToken, 0, time() + 7000);
    }

    public static function getIsvCorpAccessToken($key)
    {
        $memcache = self::getMemcache();
        return $memcache->get($key);
    }

    public static function setTmpAuthCode($tmpAuthCode)
    {
        $memcache = self::getMemcache();
        $memcache->set("tmp_auth_code", $tmpAuthCode);
    }

    public static function getTmpAuthCode()
    {
        $memcache = self::getMemcache();
        return $memcache->get("tmp_auth_code");
    }

    public static function setPermanentCode($key, $value)
    {
        $memcache = self::getMemcache();
        $memcache->set($key, $value);
    }

    public static function getPermanentCode($key)
    {
        $memcache = self::getMemcache();
        return $memcache->get($key);
    }

    public static function setActiveStatus($corpKey)
    {
        $memcache = self::getMemcache();
        $memcache->set($corpKey, 100);
    }

    public static function getActiveStatus($key)
    {
        $memcache = self::getMemcache();
        return $memcache->get($key);
    }

    public static function setCorpInfo($data)
    {
        $memcache = self::getMemcache();
        $memcache->set('dingding_corp_info', $data);
    }

    public static function getCorpInfo()
    {
        $memcache = self::getMemcache();
        $corpInfo = $memcache->get('dingding_corp_info');
        return $corpInfo;
    }


    public static function setAuthInfo($key, $authInfo)
    {
        $memcache = self::getMemcache();
        $memcache->set($key, $authInfo);
    }

    public static function getAuthInfo($key)
    {
        $memcache = self::getMemcache();
        return $memcache->get($key);
    }

    public static function removeByKeyArr($arr)
    {
        $memcache = self::getMemcache();
        foreach ($arr as $a) {
            $memcache->set($a, '');
        }
    }

    private static function getMemcache()
    {
        /*if (class_exists("Memcache"))
        {
            $memcache = new Memcache; 
            if ($memcache->connect('localhost', 11211))
            {
                return $memcache;   
            }
        }*/

        return \Yii::$app->cache;
    }

    public static function get($key)
    {
        return self::getMemcache()->get($key);
    }

    public static function set($key, $value)
    {
        self::getMemcache()->set($key, $value);
    }
}

