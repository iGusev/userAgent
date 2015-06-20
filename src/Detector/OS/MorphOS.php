<?php

namespace userAgent\userAgent\Detector\OS;


class MorphOS extends AbstractOSDetector
{
    protected static $link = 'http://www.morphos-team.net/';
    protected static $name = 'MorphOS';
    protected static $regEx = '/MorphOS/i';

    public static function detectVersion($userAgentString)
    {
        return 'unknown';
    }
}