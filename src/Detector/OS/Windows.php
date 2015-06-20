<?php

namespace userAgent\userAgent\Detector\OS;

use userAgent\userAgent\UserAgent;

class Windows extends AbstractOSDetector
{
    protected static $link = 'http://www.microsoft.com/windows/';
    protected static $name = 'Windows';
    protected static $regEx = '/Windows|Win(NT|32|95|98|16)|ZuneWP7|WPDesktop/i';
    protected static $excludedRegEx = '/Windows Phone|Ubuntu/i';
    protected static $isMobile = false;

    protected static $versionsRegEx = [
        'Windows NT (6.4|10.0)' => '10',
        'Windows NT 6.3' => '8.1',
        'Windows NT 6.2' => '8',
        'Windows NT 6.1' => '7',
        'Windows NT 6.0' => 'Vista',
        'Windows NT 5.2' => 'Server 2003',
        'Windows (NT 5.1|XP)' => 'XP',
        'Windows NT 5.01' => '2000 Service Pack 1',
        'Windows (NT 5.0|2000)' => '2000',
        'Windows NT 4.0|WinNT4.0|Windows NT\)' => 'NT 4.0',
        'Win(dows )?NT ?3.51|WinNT3.51' => 'NT 3.11',
        'Win(dows )?3.11|Win16' => '3.11',
        'Windows 3.1' => '3.1',
        'Win 9x 4.90|Windows ME' => 'ME',
        'Win98' => '98 SE',
        'Windows (98|4\.10)' => '98',
        'Windows 95|Win95|Windows 95' => '95',
        'Windows CE|Windows .+Mobile' => 'CE', // TODO!
        //        'WM5' => ' Mobile 5',
        //        'WindowsMobile' => ' Mobile'
    ];

    protected static $setMobile = [
        'CE'
    ];


    public static function detect(UserAgent $userAgent)
    {
        static::$isMobile = false;

        return parent::detect($userAgent);
    }

    public static function detectVersion($userAgentString)
    {
        $version = 'unknown';

        foreach (static::$versionsRegEx as $regEx => $currVersion) {
            if (preg_match('/' . $regEx . '/i', $userAgentString)) {
                $version = $currVersion;
                break;
            }
        }

        if (in_array($version, static::$setMobile)) {
            static::$isMobile = true;
        }

        return $version;
    }
}