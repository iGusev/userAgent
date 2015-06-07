<?php

namespace userAgent\userAgent\Tests;

use userAgent\userAgent\Tests\Fixtures\BaseTest;
use userAgent\userAgent\Tests\Fixtures\UserAgentString;
use userAgent\userAgent\UserAgent;

class IsMobileTest extends BaseTest
{
    /**
     * @dataProvider userAgentProvider
     */
    public function testIsMobile(UserAgentString $userAgentString)
    {
        $userAgent = new UserAgent($userAgentString->getString());
        $this->assertSame($userAgentString->getIsMobile(), $userAgent->isMobile());
    }
}
