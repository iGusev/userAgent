<?php

namespace userAgent\userAgent;

class UserAgent
{

    protected static $detectorsList = [
        'IE114la',
        'IE115',
        'Explorer2345'
    ];

    /**
     * @var string
     */
    protected $userAgentString;

    /**
     * @var string
     */
    protected $browser;

    /**
     * @var string
     */
    protected $browserVersion;

    /**
     * @var string
     */
    protected $os;

    /**
     * @var string
     */
    protected $osVersion;

    /**
     * @var boolean
     */
    protected $isMobile;

    public function __construct($userAgentString)
    {
        $userAgentString = trim($userAgentString);
        $this->setUserAgentString($userAgentString);

        $this->analyze($userAgentString);
    }

    /**
     * @return string
     */
    public function getUserAgentString()
    {
        return $this->userAgentString;
    }

    /**
     * @param string $userAgentString
     */
    public function setUserAgentString($userAgentString)
    {
        $this->userAgentString = $userAgentString;
    }

    /**
     * @return string
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * @param string $browser
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;
    }

    /**
     * @return string
     */
    public function getBrowserVersion()
    {
        return $this->browserVersion;
    }

    /**
     * @param string $browserVersion
     */
    public function setBrowserVersion($browserVersion)
    {
        $this->browserVersion = $browserVersion;
    }

    /**
     * @return boolean
     */
    public function isMobile()
    {
        return $this->isMobile;
    }

    /**
     * @param boolean $isMobile
     */
    public function setIsMobile($isMobile)
    {
        $this->isMobile = $isMobile;
    }

    /**
     * @return string
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * @param string $os
     */
    public function setOs($os)
    {
        $this->os = $os;
    }

    /**
     * @return string
     */
    public function getOsVersion()
    {
        return $this->osVersion;
    }

    /**
     * @param string $osVersion
     */
    public function setOsVersion($osVersion)
    {
        $this->osVersion = $osVersion;
    }

    protected static function getDetectorClass($name)
    {
        return 'userAgent\\userAgent\\Detector\\' . $name;
    }

    public function analyze($userAgentString)
    {
        foreach (self::$detectorsList as $detector) {
            $class = self::getDetectorClass($detector);
            $result = $class::detect($userAgentString);

            if ($result !== false) {
                $this->setBrowser($result['name']);
                $this->setBrowserVersion($result['version']);
                $this->setIsMobile($result['is_mobile']);
                break;
            }
        }
    }
}
