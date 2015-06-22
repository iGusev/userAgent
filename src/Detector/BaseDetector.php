<?php

namespace userAgent\userAgent\Detector;


use userAgent\userAgent\UserAgent;

abstract class BaseDetector
{
    protected static $link = '';
    protected static $name = '';
    protected static $regEx = '';
    protected static $excludedRegEx = '';
    protected static $isMobile = false;
    protected static $isX64 = false;

    public static function detect(UserAgent $userAgent)
    {
        $userAgentString = $userAgent->getUserAgentString();

        if (strlen(static::$excludedRegEx)) {
            $excludeResult = !preg_match(static::$excludedRegEx, $userAgentString);
        } else {
            $excludeResult = true;
        }

        if (preg_match(static::$regEx, $userAgentString, $result) && $excludeResult) {
            $userAgent->setBrowser(static::$name);
            $userAgent->setBrowserVersion(static::detectVersion($userAgentString));
            $userAgent->setIsMobile(static::$isMobile);

            return true;
        }

        return false;
    }

    public static function detectVersion($userAgentString)
    {
        // Grab the browser version if its present
        $version = 'unknown';
        $start = preg_quote(substr(static::$regEx, 1, strlen(static::$regEx) - 3));
        if (preg_match('/' . $start . '[\ ]?[\/|\:|\(]?([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
            if (count($regmatch) > 1) {
                $version = $regmatch[1];
            }
        }

        return $version;
    }

    public static function detectOS($userAgentString)
    {
        $result = array();
        // Check if is AMD64
        if (preg_match('/x86_64|Win64; x64|WOW64/i', $userAgentString)) {
            static::$isX64 = true;
        }

        if (preg_match('/Linux/i', $userAgentString) && !preg_match('/Android|ADR/', $userAgentString)) {
            $result = self::analyzeLinux($userAgentString);
        } else {
            $result = self::analyzeOther($userAgentString);
        }

        return $result;
    }

    public static function analyzeLinux($userAgentString)
    {
        $link = '';
        $title['osName'] = '';
        $code = '';
        $version = '';
        if (preg_match('/[^A-Za-z]Arch/i', $userAgentString)) {
            $link = "http://www.archlinux.org/";
            $title['osName'] = "Arch Linux";
            $code = "archlinux";
        } elseif (preg_match('/Chakra/i', $userAgentString)) {
            $link = "http://www.chakra-linux.org/";
            $title['osName'] = "Chakra Linux";
            $code = "chakra";
            // @codeCoverageIgnoreEnd
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Crunchbang/i', $userAgentString)) {
            $link = "http://www.crunchbanglinux.org/";
            $title['osName'] = "Crunchbang";
            $code = "crunchbang";
            // @codeCoverageIgnoreEnd
        } elseif (preg_match('/Debian/i', $userAgentString)) {
            $link = "http://www.debian.org/";
            $title['osName'] = "Debian GNU/Linux";
            $code = "debian";
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Edubuntu/i', $userAgentString)) {
            $link = "http://www.edubuntu.org/";
            $title['osName'] = "Edubuntu";
            if (preg_match('/Edubuntu[\/|\ ]([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $version .= " " . $regmatch[1];
            }
            if ($regmatch[1] < 10) {
                $code = "edubuntu-1";
            } else {
                $code = "edubuntu-2";
            }
            if (strlen($version) > 1) {
                $title .= $version;
            }
            // @codeCoverageIgnoreEnd
        } elseif (preg_match('/Fedora/i', $userAgentString)) {
            $link = "http://www.fedoraproject.org/";
            $title['osName'] = "Fedora";
            if (preg_match('/.fc([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $title['osName'] .= " " . $regmatch[1];
            }
            $code = "fedora";
        } elseif (preg_match('/Foresight\ Linux/i', $userAgentString)) {
            $link = "http://www.foresightlinux.org/";
            $title['osName'] = "Foresight Linux";
            if (preg_match('/Foresight\ Linux\/([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $title['osName'] .= " " . $regmatch[1];
            }
            $code = "foresight";
        } elseif (preg_match('/Knoppix/i', $userAgentString)) {
            $link = "http://www.knoppix.net/";
            $title['osName'] = "Knoppix";
            $code = "knoppix";
            // @codeCoverageIgnoreEnd
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/LindowsOS/i', $userAgentString)) {
            $link = "http://en.wikipedia.org/wiki/Lsongs";
            $title['osName'] = "LindowsOS";
            $code = "lindowsos";
        } elseif (preg_match('/Linspire/i', $userAgentString)) {
            $link = "http://www.linspire.com/";
            $title['osName'] = "Linspire";
            $code = "lindowsos";
        } elseif (preg_match('/Linux\ Mint/i', $userAgentString)) {
            $link = "http://www.linuxmint.com/";
            $title['osName'] = "Linux Mint";
            if (preg_match('/Linux\ Mint\/([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $title .= " " . $regmatch[1];
            }
            $code = "linuxmint";
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Lubuntu/i', $userAgentString)) {
            $link = "http://www.lubuntu.net/";
            $title['osName'] = "Lubuntu";
            if (preg_match('/Lubuntu[\/|\ ]([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $version .= " " . $regmatch[1];
            }
            if ($regmatch[1] < 10) {
                $code = "lubuntu-1";
            } else {
                $code = "lubuntu-2";
            }
            if (strlen($version) > 1) {
                $title['osName'] .= $version;
            }
            // @codeCoverageIgnoreEnd
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Mageia/i', $userAgentString)) {
            $link = "http://www.mageia.org/";
            $title['osName'] = "Mageia";
            $code = "mageia";
            // @codeCoverageIgnoreEnd
        } elseif (preg_match('/Mandriva/i', $userAgentString)) {
            $link = "http://www.mandriva.com/";
            $title['osName'] = "Mandriva";
            // @codeCoverageIgnoreStart
            if (preg_match('/mdv([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $title['osName'] .= " " . $regmatch[1];
            }
            // @codeCoverageIgnoreEnd
            $code = "mandriva";
        } elseif (preg_match('/Nova/i', $userAgentString)) {
            $link = "http://www.nova.cu";
            $title['osName'] = "Nova";
            if (preg_match('/Nova[\/|\ ]([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $version .= " " . $regmatch[1];
            }
            if (strlen($version) > 1) {
                $title['osName'] .= $version;
            }
            $code = "nova";
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Oracle/i', $userAgentString)) {
            $link = "http://www.oracle.com/us/technologies/linux/";
            $title['osName'] = "Oracle";
            if (preg_match('/.el([._0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $title['osName'] .= " Enterprise Linux " . str_replace("_", ".", $regmatch[1]);
            } else {
                $title['osName'] .= " Linux";
            }
            $code = "oracle";
            // @codeCoverageIgnoreEnd
        } elseif (preg_match('/Pardus/i', $userAgentString)) {
            $link = "http://www.pardus.org.tr/en/";
            $title['osName'] = "Pardus";
            $code = "pardus";
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/PCLinuxOS/i', $userAgentString)) {
            $link = "http://www.pclinuxos.com/";
            $title['osName'] = "PCLinuxOS";
            if (preg_match('/PCLinuxOS\/[.\-0-9a-zA-Z]+pclos([.\-0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $title['osName'] .= " " . str_replace("_", ".", $regmatch[1]);
            }
            $code = "pclinuxos";
            // @codeCoverageIgnoreEnd
        } elseif (preg_match('/Rosa/i', $userAgentString)) {
            $link = "http://www.rosalab.com/";
            $title['osName'] = "Rosa Linux";
            $code = "rosa";
            // @codeCoverageIgnoreEnd
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Sabayon/i', $userAgentString)) {
            $link = "http://www.sabayonlinux.org/";
            $title['osName'] = "Sabayon Linux";
            $code = "sabayon";
            // @codeCoverageIgnoreEnd
        } elseif (preg_match('/VectorLinux/i', $userAgentString)) {
            $link = "http://www.vectorlinux.com/";
            $title['osName'] = "VectorLinux";
            $code = "vectorlinux";
            // @codeCoverageIgnoreEnd
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Venenux/i', $userAgentString)) {
            $link = "http://www.venenux.org/";
            $title['osName'] = "Venenux GNU Linux";
            $code = "venenux";
            // @codeCoverageIgnoreEnd
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Xandros/i', $userAgentString)) {
            $link = "http://www.xandros.com/";
            $title['osName'] = "Xandros";
            $code = "xandros";
            // @codeCoverageIgnoreEnd
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Xubuntu/i', $userAgentString)) {
            $link = "http://www.xubuntu.org/";
            $title['osName'] = "Xubuntu";
            if (preg_match('/Xubuntu[\/|\ ]([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $version .= " " . $regmatch[1];
            }
            if ($regmatch[1] < 10) {
                $code = "xubuntu-1";
            } else {
                $code = "xubuntu-2";
            }
            if (strlen($version) > 1) {
                $title['osName'] .= $version;
            }
            // @codeCoverageIgnoreEnd
        } elseif (preg_match('/Zenwalk/i', $userAgentString)) {
            $link = "http://www.zenwalk.org/";
            $title['osName'] = "Zenwalk GNU Linux";
            $code = "zenwalk";
        } // Pulled out of order to help ensure better detection for above platforms
        else {
            $link = "http://www.linux.org/";
            $title = "GNU/Linux";
            $code = "linux";
        }

        return $title;
    }

    public static function analyzeOther($userAgentString)
    {
        $link = '';
        $title['osName'] = '';
        $code = '';
        $version = '';
        // Opera's Useragent does not contains 'Linux'
        if (preg_match('/BB10/i', $userAgentString)) {
            $link = "http://www.blackberry.com/";
            $title['osName'] = "BlackBerry OS 10";
            $code = "blackberry";
        } elseif (preg_match('/BeOS/i', $userAgentString)) {
            $link = "http://en.wikipedia.org/wiki/BeOS";
            $title['osName'] = "BeOS";
            $code = "beos";
        } elseif (preg_match('/\b(?!Mi)CrOS(?!oft)/i', $userAgentString)) {
            $link = "http://en.wikipedia.org/wiki/Google_Chrome_OS";
            $title['osName'] = "Google Chrome OS";
            $code = "chromeos";
        } elseif (preg_match('/DragonFly/i', $userAgentString)) {
            $link = "http://www.dragonflybsd.org/";
            $title['osName'] = "DragonFly BSD";
            $code = "dragonflybsd";
        } elseif (preg_match('/Inferno/i', $userAgentString)) {
            $link = "http://www.vitanuova.com/inferno/";
            $title['osName'] = "Inferno";
            $code = "inferno";
        } elseif (preg_match('/RISC OS/i', $userAgentString)) {
            $link = "https://www.riscosopen.org/";
            $title['osName'] = "RISC OS";
            $code = "risc";
            if (preg_match('/RISC OS ([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $title['osName'] .= " " . $regmatch[1];
            }
        } elseif (preg_match('/Unix/i', $userAgentString)) {
            $link = "http://www.unix.org/";
            $title['osName'] = "Unix";
            $code = "unix";
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/webOS/i', $userAgentString)) {
            $link = "http://en.wikipedia.org/wiki/WebOS";
            $title['osName'] = "Palm webOS";
            $code = "palm";
        }  else {
            $code = "null";
        }

        return $title;
    }
}