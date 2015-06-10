<?php

namespace userAgent\userAgent\Detector;

use userAgent\userAgent\UserAgent;

class InternetExplorer extends BaseDetector
{
    protected static $link = 'http://www.microsoft.com/windows/products/winfamily/ie/default.mspx';
    protected static $name = 'Internet Explorer';
    protected static $regEx = '/MSIE|Trident/i';
    protected static $excludedRegEx = '/IEMobile/i';

    public static function detect(UserAgent $userAgent)
    {
        $userAgentString = $userAgent->getUserAgentString();
        $output = [];

        if (preg_match(static::$regEx, $userAgentString, $result) && !preg_match(static::$excludedRegEx, $userAgentString)) {
            $userAgent->setBrowser(static::$name);
            $userAgent->setBrowserVersion(static::detectVersion($userAgentString));
            $userAgent->setIsMobile(static::$isMobile);

            if ($os = self::detectOS($userAgentString)) {
                if (isset($os['osName'])) {
                    $output['osName'] = $os['osName'];
                } else {
                    $output['osName'] = 'unknown';
                }

                if (isset($os['osVersion'])) {
                    $output['osVersion'] = $os['osVersion'];
                } else {
                    $output['osVersion'] = 'unknown';
                }
            }
        }

        if (!empty($output)) {
            return $output;
        }

        return false;
    }


    public static function detectVersion($userAgentString)
    {
        // Grab the browser version if its present
        $version = 'unknown';


        // TODO: Detect compatible mode (when rv and msie)
        if (preg_match('/\ rv:([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)
            || preg_match('/MSIE[\ |\/]?([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)
        ) {
            $version = $regmatch[1];
        }

        return $version;
    }
}