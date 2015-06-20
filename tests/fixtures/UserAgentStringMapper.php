<?php

namespace userAgent\userAgent\Tests\Fixtures;

use Symfony\Component\Yaml\Yaml;

class UserAgentStringMapper
{
    /**
     * @return UserAgentString[]
     */
    public static function map()
    {
        $collection = array();
        $yml = Yaml::parse(file_get_contents('tests/fixtures/userAgentStrings.yml'));

        foreach ($yml as $fixture) {
            $userAgentString = new UserAgentString();
            $userAgentString->setString($fixture['userAgent']);
            $userAgentString->setBrowser($fixture['browser']['name']);
            $userAgentString->setBrowserVersion($fixture['browser']['version']);
            $userAgentString->setOs($fixture['os']['name']);
            $userAgentString->setOsVersion($fixture['os']['version']);
            $userAgentString->setDevice($fixture['device']['name']);
            $userAgentString->setDeviceVersion($fixture['device']['Version']);
            $userAgentString->setIsMobile($fixture['isMobile']);
            $collection[] = $userAgentString;
        }

        return $collection;
    }
}