<?php

namespace userAgent\userAgent\Detector;


abstract class BaseDetector
{
    protected static $link = '';
    protected static $browserName = '';
    protected static $browserRegEx = '';
    protected static $isMobile = false;

    public static function detect($userAgentString)
    {
        $regExString = '/(' . static::$browserRegEx . ')/i';

        var_dump(static::$browserRegEx);
        if (preg_match($regExString, $userAgentString, $result)) {
            if (strtolower($result[1]) === strtolower(static::$browserName)) {
                $output['name'] = static::$browserName;
                $output['version'] = static::detectVersion($userAgentString);

                return [
                    'name' => static::$browserName,
                    'version' => static::detectVersion($userAgentString),
                    'is_mobile' => static::$isMobile
                ];
            }
        }

        return false;
    }

    public static function detectVersion($userAgentString)
    {
        // Grab the browser version if its present
        $version = 'Unknown';
        $start = preg_quote(static::$browserName);
        if (preg_match('/' . $start . '[\ |\/|\:]?([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
            if (count($regmatch) > 1) {
                $version = $regmatch[1];
            }
        }

        return $version;
    }
}