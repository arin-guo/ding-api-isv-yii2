<?php

namespace GuoGq\DingApiIsvYii2\util;

class Log
{
    public static function i($msg)
    {
        self::write('I', $msg);
    }

    public static function e($msg)
    {
        self::write('E', $msg);
    }

    private static function write($level, $msg)
    {
        //在yii2项目目录runtime下logs存放
        $path = \Yii::getAlias('@runtime') . '/logs';
        if (is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $filename = $path . "/isv.log";
        $logFile = fopen($filename, "aw");
        fwrite($logFile, $level . "/" . date(" Y-m-d h:i:s") . "  " . $msg . "\n");
        fclose($logFile);
    }
}
