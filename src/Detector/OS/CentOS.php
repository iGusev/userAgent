<?php

namespace userAgent\userAgent\Detector\OS;


class CentOS extends AbstractOSDetector
{
    protected static $link = 'http://www.centos.org/';
    protected static $name = 'CentOS';
    protected static $regEx = '/CentOS/i';
    protected static $regExVersion = '/.el([.0-9a-zA-Z]+).centos/i';

    public static function detectVersion($userAgentString)
    {
        $version = 'unknown';

        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            $version = str_replace('_', '.', $regmatch[1]);
        }

        return $version;
    }
}