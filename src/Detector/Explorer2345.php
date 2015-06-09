<?php

namespace userAgent\userAgent\Detector;


class Explorer2345
{
    const LINK = 'http://ie.2345.com/';
    const BROWSER_NAME = '2345Explorer';
    const BROWSER_REGEX = '2345Explorer';
    const BROWSER_VERSION_REGEX = '';
    const IS_MOBILE = false;

    public static function detect($userAgentString)
    {
        $regExString = '/(' . self::BROWSER_REGEX . ')/i';

        if (preg_match($regExString, $userAgentString, $result)) {
            if (strtolower($result[1]) === strtolower(self::BROWSER_NAME)) {
                $output['name'] = self::BROWSER_NAME;
                $output['version'] = self::detectVersion($userAgentString);

                return [
                    'name' => self::BROWSER_NAME,
                    'version' => self::detectVersion($userAgentString),
                    'is_mobile' => self::IS_MOBILE
                ];
            }
        }

        return false;
    }


    public static function detectVersion($userAgentString)
    {
        // Grab the browser version if its present
        $version = 'Unknown';
        $start = preg_quote(self::BROWSER_NAME);
        if (preg_match('/' . $start . '[\ |\/|\:]?([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
            if (count($regmatch) > 1) {
                $version = $regmatch[1];
            }
        }

        return $version;
    }
}