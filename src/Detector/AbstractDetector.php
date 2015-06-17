<?php
namespace userAgent\userAgent\Detector;


use userAgent\userAgent\UserAgent;

abstract class AbstractDetector
{
    protected static $link = '';
    protected static $name = '';
    protected static $regEx = '';
    protected static $excludedRegEx = '';
    protected static $isMobile = false;
    protected static $isX64 = false;

    public static function detect(\userAgent\userAgent\UserAgent $userAgent)
    {
        $userAgentString = $userAgent->getUserAgentString();
        $excludeResult = true;

        if (strlen(static::$excludedRegEx)) {
            $excludeResult = !preg_match(static::$excludedRegEx, $userAgentString);
        }

        if (preg_match(static::$regEx, $userAgentString, $result) && $excludeResult) {
            static::setParams($userAgent);

            return true;
        }

        return false;
    }

    protected static function setParams(UserAgent $userAgent)
    {

    }

    public static function detectVersion($userAgentString)
    {
        // Grab the browser version if its present
        $version = 'unknown';
        $start = substr(static::$regEx, 1, strlen(static::$regEx) - 3);
        if (preg_match('/' . $start . '[\ ]?[\/|\:|\(]?([_.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
            if (count($regmatch) > 1) {
                $version = str_replace('_', '.', $regmatch[1]);
            }
        }

        return $version;
    }

}