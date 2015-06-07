<?php

namespace userAgent\userAgent\Tests\Fixtures;

class UserAgentStringMapper
{
    /**
     * @return UserAgentString[]
     */
    public static function map()
    {
        $collection = array();
        $xml = new \SimpleXMLElement(file_get_contents('tests/fixtures/userAgentStrings.xml'));
        foreach ($xml->strings->string as $string) {
            $string = $string->field;
            $userAgentString = new UserAgentString();
            $userAgentString->setBrowser((string) $string[0]);
            $userAgentString->setBrowserVersion((string) $string[1]);
            $userAgentString->setOs((string) $string[2]);
            $userAgentString->setOsVersion((string) $string[3]);
            $userAgentString->setDevice((string) $string[4]);
            $userAgentString->setDeviceVersion((string) $string[5]);
            $is_mobile = (string) $string[6];
            $is_mobile === 'true' ? $userAgentString->setIsMobile(true) : $userAgentString->setIsMobile(false);
            $userAgentString->setString(str_replace(array(PHP_EOL, '  '), ' ', (string) $string[7]));
            $collection[] = $userAgentString;
        }

        return $collection;
    }
}