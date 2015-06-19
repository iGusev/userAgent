<?php

namespace userAgent\userAgent\Detector;


class AtomicBrowser extends AbstractBrowserDetector
{
    protected static $link = 'http://www.atomicwebbrowser.com/';
    protected static $name = 'Atomic Web Browser';
    protected static $regEx = '/AtomicBrowser/i';
}