<?php

namespace userAgent\userAgent\Tests\Fixtures;

class BaseTest extends \PHPUnit_Framework_TestCase
{
    public function userAgentProvider()
    {
        $data = [];
        $userAgentStringCollection = UserAgentStringMapper::map();
        foreach ($userAgentStringCollection as $userAgentString) {
            $data[] = array($userAgentString);
        }

        return $data;
    }

}