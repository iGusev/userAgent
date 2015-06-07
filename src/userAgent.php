<?php

namespace userAgent\userAgent;

class UserAgent
{
    /**
     * @var string
     */
    protected $browser;

    /**
     * @var string
     */
    protected $browserVersion;

    /**
     * @var boolean
     */
    protected $is_mobile;

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
}
