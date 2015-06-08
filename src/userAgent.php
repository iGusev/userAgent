<?php

namespace userAgent\userAgent;

class UserAgent
{
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

     * @var boolean
     */
    protected $is_mobile;

    public function __construct($userAgentString)
    {
        $this->setUserAgentString($userAgentString);
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
        return $this->is_mobile;
    }

    /**
     * @param boolean $is_mobile
     */
    public function setIsMobile($is_mobile)
    {
        $this->is_mobile = $is_mobile;
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

}
