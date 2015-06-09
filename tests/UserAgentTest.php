<?php

namespace userAgent\userAgent\Tests;


use userAgent\userAgent\UserAgent;

class UserAgentTest extends \PHPUnit_Framework_TestCase
{
    public function testUserAgentString()
    {
        $userAgent = new UserAgent('unknown');
        $this->assertEquals('unknown', $userAgent->getUserAgentString());
        $userAgent->setUserAgentString('unknown2');
        $this->assertEquals('unknown2', $userAgent->getUserAgentString());
    }

    public function testBrowser()
    {
        $userAgent = new UserAgent('unknown');
        $userAgent->setBrowser('unknown');
        $this->assertAttributeEquals('unknown', 'browser', $userAgent);
    }
    public function testBrowserVersion()
    {
        $userAgent = new UserAgent('unknown');
        $userAgent->setBrowserVersion('unknown');
        $this->assertAttributeEquals('unknown', 'browserVersion', $userAgent);
    }
    public function testIsMobile()
    {
        $userAgent = new UserAgent('unknown');
        $userAgent->setIsMobile(true);
        $this->assertAttributeEquals(true, 'isMobile', $userAgent);
    }
    public function testOs()
    {
        $userAgent = new UserAgent('unknown');
        $userAgent->setOs('unknown');
        $this->assertAttributeEquals('unknown', 'os', $userAgent);
        $this->assertEquals('unknown', $userAgent->getOs());
    }
    public function testOsVersion()
    {
        $userAgent = new UserAgent('unknown');
        $userAgent->setOsVersion('unknown');
        $this->assertAttributeEquals('unknown', 'osVersion', $userAgent);
    }
}
