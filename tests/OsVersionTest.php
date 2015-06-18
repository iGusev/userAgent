<?php

namespace userAgent\userAgent\Tests;

use userAgent\userAgent\Tests\Fixtures\BaseTest;
use userAgent\userAgent\Tests\Fixtures\UserAgentString;
use userAgent\userAgent\UserAgent;

class OsVersionTest extends BaseTest
{
    /**
     * @dataProvider userAgentProvider
     */
    public function testOsVersion(UserAgentString $userAgentString)
    {
        $userAgent = new UserAgent($userAgentString->getString());
        $this->assertEquals($userAgentString->getosVersion(), $userAgent->getOsVersion());
    }
}