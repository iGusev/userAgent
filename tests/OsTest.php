<?php

namespace userAgent\userAgent\Tests;

use userAgent\userAgent\Tests\Fixtures\BaseTest;
use userAgent\userAgent\Tests\Fixtures\UserAgentString;
use userAgent\userAgent\UserAgent;

class OsTest extends BaseTest
{
    /**
     * @dataProvider userAgentProvider
     */
    public function testBrowser(UserAgentString $userAgentString)
    {
        $userAgent = new UserAgent($userAgentString->getString());
        $this->assertEquals($userAgentString->getOs(), $userAgent->getOs());
    }
}