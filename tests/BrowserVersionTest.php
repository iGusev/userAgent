<?php

namespace userAgent\userAgent\Tests;

use userAgent\userAgent\Tests\Fixtures\BaseTest;
use userAgent\userAgent\Tests\Fixtures\UserAgentString;
use userAgent\userAgent\UserAgent;

class BrowserVersionTest extends BaseTest
{
    /**
     * @dataProvider userAgentProvider
     */
    public function testBrowserVersion(UserAgentString $userAgentString)
    {
        $userAgent = new UserAgent($userAgentString->getString());
        $this->assertEquals($userAgentString->getBrowserVersion(), $userAgent->getBrowserVersion());
    }
}
