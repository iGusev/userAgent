<?php

namespace userAgent\userAgent\Tests;

class UserAgentStringMapper
{
    /**
     * @return UserAgentString[]
     */
    public static function map()
    {
        $collection = array();
        $xml = new SimpleXmlElement(file_get_contents(FILES . DIRECTORY_SEPARATOR . 'UserAgentStrings.xml'));
        foreach ($xml->strings->string as $string) {
            $string = $string->field;
            $userAgentString = new UserAgentString();
            $userAgentString->setBrowser((string) $string[0]);
            $userAgentString->setBrowserVersion((string) $string[1]);
            $userAgentString->setOs((string) $string[2]);
            $userAgentString->setOsVersion((string) $string[3]);
            $userAgentString->setDevice((string) $string[4]);
            $userAgentString->setDeviceVersion((string) $string[5]);
            $userAgentString->setDeviceVersion((bool) $string[6]);
            $userAgentString->setString(str_replace(array(PHP_EOL, '  '), ' ', (string) $string[7]));
            $collection[] = $userAgentString;
        }

        return $collection;
    }
}