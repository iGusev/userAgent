<?php

namespace userAgent\userAgent\Detector;


class Amigo extends BaseDetector {
    protected static $link = 'http://amigo.mail.ru/';
    protected static $name = 'Amigo';
    protected static $regEx = '/MRCHROME/i';


    public static function detectVersion($userAgentString)
    {
        if (preg_match('/Chrome[\ ]?[\/|\:|\(]?([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                return $regmatch[1];
        }

        return 'unknown';
    }
}