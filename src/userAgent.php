<?php

namespace userAgent\userAgent;

class UserAgent
{

    /**
     * @var string
     */
    protected $browser;

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

}