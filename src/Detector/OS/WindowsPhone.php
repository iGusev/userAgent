<?php

namespace userAgent\userAgent\Detector\OS;

use Symfony\Component\Process\Pipes\WindowsPipes;

class WindowsPhone extends Windows
{
    protected static $link = 'http://www.windowsphone.com/';
    protected static $name = 'Windows Phone';
    protected static $regEx = '/Windows Phone|WPDesktop|ZuneWP7|WP7/i';
    protected static $isMobile = true;

    public static function detectVersion($userAgentString)
    {
        if (preg_match('/Windows Phone (OS )?([0-9\.]+)/i', $userAgentString, $regmatch)) {
            return $regmatch[2];
        }

        return 'unknown';
    }
}