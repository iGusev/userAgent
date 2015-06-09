<?php

namespace userAgent\userAgent\Detector;


abstract class BaseDetector
{
    protected static $link = '';
    protected static $name = '';
    protected static $regEx = '';
    protected static $isMobile = false;
    protected static $isX64 = false;

    public static function detect($userAgentString)
    {
        $output = [];
        $regExString = '/(' . static::$regEx . ')/i';

        if (preg_match($regExString, $userAgentString, $result)) {
            if (strtolower($result[1]) === strtolower(static::$regEx)) {
                $output = [
                    'name' => static::$name,
                    'version' => static::detectVersion($userAgentString),
                    'is_mobile' => static::$isMobile
                ];

                if ($os = self::detectOS($userAgentString)) {
                    if (isset($os['osName'])) {
                        $output['osName'] = $os['osName'];
                    } else {
                        $output['osName'] = 'unknown';
                    }

                    if (isset($os['osVersion'])) {
                        $output['osVersion'] = $os['osVersion'];
                    } else {
                        $output['osVersion'] = 'unknown';
                    }
                }
            }
        }

        if (!empty($output)) {
            return $output;
        }

        return false;
    }

    public static function detectVersion($userAgentString)
    {
        // Grab the browser version if its present
        $version = 'unknown';
        $start = preg_quote(static::$regEx);
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
        // Check Linux
        if (preg_match('/Windows|Win(NT|32|95|98|16)|ZuneWP7|WPDesktop/i', $userAgentString)) {
            $result = self::analyzeWindows($userAgentString);
        } else {
            if (preg_match('/Linux/i', $userAgentString) && !preg_match('/Android|ADR/', $userAgentString)) {
                $result = self::analyzeLinux($userAgentString);
            } else {
                $result = self::analyzeOther($userAgentString);
            }
        }

        return $result;
    }

    public static function analyzeWindows($userAgentString)
    {
        $link = "http://www.microsoft.com/windows/";
        $title = ['osName' => 'Windows'];
        $code = 'win-2';
        if (preg_match('/Windows Phone|WPDesktop|ZuneWP7|WP7/i', $userAgentString)) {
            $link = "http://www.windowsphone.com/";
            $title['osName'] .= ' Phone';
            $code = "windowsphone";
            if (preg_match('/Windows Phone (OS )?([0-9\.]+)/i', $userAgentString, $regmatch)) {
                $title['osVersion'] = $regmatch[2];
                if ((int) $regmatch[2] == 7) {
                    $code = "wp7";
                }
            }
        } elseif (preg_match('/Windows NT (6.4|10.0)/i', $userAgentString)) {
            $title['osVersion'] = "10";
            $code = "win-5";
        } elseif (preg_match('/Windows NT 6.3/i', $userAgentString)) {
            $title['osVersion'] = "8.1";
            $code = "win-5";
        } elseif (preg_match('/Windows NT 6.2/i', $userAgentString)) {
            $title['osVersion'] = "8";
            $code = "win-5";
        } elseif (preg_match('/Windows NT 6.1/i', $userAgentString)) {
            $title['osVersion'] = "7";
            $code = "win-4";
        } elseif (preg_match('/Windows NT 6.0/i', $userAgentString)) {
            $title['osVersion'] = "Vista";
            $code = "win-3";
        } elseif (preg_match('/Windows NT 5.2/i', $userAgentString)) {
            $title['osVersion'] = "Server 2003";
            $code = "win-2";
        } elseif (preg_match('/Windows (NT 5.1|XP)/i', $userAgentString)) {
            $title['osVersion'] = "XP";
            $code = "win-2";
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Windows NT 5.01/i', $userAgentString)) {
            $title['osVersion'] = "2000 Service Pack 1";
            $code = "win-1";
            // @codeCoverageIgnoreEnd
        } elseif (preg_match('/Windows (NT 5.0|2000)/i', $userAgentString)) {
            $title['osVersion'] = "2000";
            $code = "win-1";
        } elseif (preg_match('/Windows NT 4.0/i', $userAgentString)
            || preg_match('/WinNT4.0/i', $userAgentString)
        ) {
            $title['osVersion'] = "NT 4.0";
            $code = "win-1";
        } elseif (preg_match('/Win(dows )?NT ?3.51/i', $userAgentString)
            || preg_match('/WinNT3.51/i', $userAgentString)
        ) {
            $title['osVersion'] = "NT 3.11";
            $code = "win-1";
        } elseif (preg_match('/Win(dows )?3.11|Win16/i', $userAgentString)) {
            $title['osVersion'] = "3.11";
            $code = "win-1";
        } elseif (preg_match('/Windows 3.1/i', $userAgentString)) {
            $title['osVersion'] = "3.1";
            $code = "win-1";
        } elseif (preg_match('/Win 9x 4.90|Windows ME/i', $userAgentString)) {
            $title['osVersion'] = "Me";
            $code = "win-1";
        } elseif (preg_match('/Win98/i', $userAgentString)) {
            $title['osVersion'] = "98 SE";
            $code = "win-1";
        } elseif (preg_match('/Windows (98|4\.10)/i', $userAgentString)) {
            $title['osVersion'] = "98";
            $code = "win-1";
        } elseif (preg_match('/Windows 95/i', $userAgentString)
            || preg_match('/Win95/i', $userAgentString)
        ) {
            $title['osVersion'] = "95";
            $code = "win-1";
        } elseif (preg_match('/Windows CE|Windows .+Mobile/i', $userAgentString)) {
            $title['osVersion'] = "CE";
            $code = "win-2";
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/WM5/i', $userAgentString)) {
            $title['osName'] .= " Mobile";
            $title['osVersion'] = "5";
            $code = "win-phone";
        } elseif (preg_match('/WindowsMobile/i', $userAgentString)) {
            $title['osName'] .= " Mobile";
            $code = "win-phone";
        }

        // @codeCoverageIgnoreEnd
        return $title;
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
        } elseif (preg_match('/CentOS/i', $userAgentString)) {
            $link = "http://www.centos.org/";
            $title['osName'] = "CentOS";
            if (preg_match('/.el([.0-9a-zA-Z]+).centos/i', $userAgentString, $regmatch)) {
                $title['osName'] .= " " . $regmatch[1];
            }
            $code = "centos";
            // @codeCoverageIgnoreStart
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
        } elseif (preg_match('/Gentoo/i', $userAgentString)) {
            $link = "http://www.gentoo.org/";
            $title['osName'] = "Gentoo";
            $code = "gentoo";
        } elseif (preg_match('/Kanotix/i', $userAgentString)) {
            $link = "http://www.kanotix.com/";
            $title['osName'] = "Kanotix";
            $code = "kanotix";
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Knoppix/i', $userAgentString)) {
            $link = "http://www.knoppix.net/";
            $title['osName'] = "Knoppix";
            $code = "knoppix";
            // @codeCoverageIgnoreEnd
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/Kubuntu/i', $userAgentString)) {
            $link = "http://www.kubuntu.org/";
            $title['osName'] = "Kubuntu";
            if (preg_match('/Kubuntu[\/|\ ]([.0-9]+)/i', $userAgentString, $regmatch)) {
                $version .= " " . $regmatch[1];
                if ($regmatch[1] < 10) {
                    $code = "kubuntu-1";
                } else {
                    $code = "kubuntu-2";
                }
            } else {
                $code = "kubuntu-2";
            }
            if (strlen($version) > 1) {
                $title .= $version;
            }
            // @codeCoverageIgnoreEnd
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
        } elseif (preg_match('/moonOS/i', $userAgentString)) {
            $link = "http://www.moonos.org/";
            $title['osName'] = "moonOS";
            if (preg_match('/moonOS\/([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $title['osName'] .= " " . $regmatch[1];
            }
            $code = "moonos";
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
        } elseif (preg_match('/Red\ Hat/i', $userAgentString)
            || preg_match('/RedHat/i', $userAgentString)
        ) {
            $link = "http://www.redhat.com/";
            $title['osName'] = "Red Hat";
            if (preg_match('/.el([._0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $title['osName'] .= " Enterprise Linux " . str_replace("_", ".", $regmatch[1]);
            }
            $code = "red-hat";
            // @codeCoverageIgnoreStart
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
        } elseif (preg_match('/Slackware/i', $userAgentString)) {
            $link = "http://www.slackware.com/";
            $title['osName'] = "Slackware";
            $code = "slackware";
        } elseif (preg_match('/Suse/i', $userAgentString)) {
            $link = "http://www.opensuse.org/";
            $title['osName'] = "openSUSE";
            $code = "suse";
            // @codeCoverageIgnoreStart
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
        elseif (preg_match('/Ubuntu/i', $userAgentString)) {
            $link = "http://www.ubuntu.com/";
            $title['osName'] = "Ubuntu";
            if (preg_match('/Ubuntu[\/|\ ]([.0-9]+[.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $version .= " " . $regmatch[1];
                if ($regmatch[1] < 10) {
                    $code = "ubuntu-1";
                }
            }
            if ($code == '') {
                $code = "ubuntu-2";
            }
            if (strlen($version) > 1) {
                $title['osName'] .= $version;
            }
        } else {
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
        if (preg_match('/Android|ADR /i', $userAgentString)) {
            $link = "http://www.android.com/";
            $title['osName'] = "Android";
            $code = "android";
            if (preg_match('/(Android|Adr)[\ |\/]?([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $version = $regmatch[2];
                $title['osVersion'] = $version;
            }
        } elseif (preg_match('/AmigaOS/i', $userAgentString)) {
            $link = "http://en.wikipedia.org/wiki/AmigaOS";
            $title['osName'] = "AmigaOS";
            if (preg_match('/AmigaOS\ ([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $title['osVersion'] = $regmatch[1];
            }
            $code = "amigaos";
        } elseif (preg_match('/BB10/i', $userAgentString)) {
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
        } elseif (preg_match('/FreeBSD/i', $userAgentString)) {
            $link = "http://www.freebsd.org/";
            $title['osName'] = "FreeBSD";
            $code = "freebsd";
        } elseif (preg_match('/Inferno/i', $userAgentString)) {
            $link = "http://www.vitanuova.com/inferno/";
            $title['osName'] = "Inferno";
            $code = "inferno";
        } elseif (preg_match('/IRIX/i', $userAgentString)) {
            $link = "http://www.sgi.com/partners/?/technology/irix/";
            $title['osName'] = "IRIX";
            if (preg_match('/IRIX(64)?\ ([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                if ($regmatch[1]) {
                    self::$isX64 = true;
                }
                if ($regmatch[2]) {
                    $title['osName'] .= " " . $regmatch[2];
                }
            }
            $code = "irix";
        } elseif (preg_match('/MorphOS/i', $userAgentString)) {
            $link = "http://www.morphos-team.net/";
            $title['osName'] = "MorphOS";
            $code = "morphos";
        } elseif (preg_match('/NetBSD/i', $userAgentString)) {
            $link = "http://www.netbsd.org/";
            $title['osName'] = "NetBSD";
            $code = "netbsd";
        } elseif (preg_match('/OpenBSD/i', $userAgentString)) {
            $link = "http://www.openbsd.org/";
            $title['osName'] = "OpenBSD";
            $code = "openbsd";
        } elseif (preg_match('/RISC OS/i', $userAgentString)) {
            $link = "https://www.riscosopen.org/";
            $title['osName'] = "RISC OS";
            $code = "risc";
            if (preg_match('/RISC OS ([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $title['osName'] .= " " . $regmatch[1];
            }
        } elseif (preg_match('/Solaris|SunOS/i', $userAgentString)) {
            $link = "http://www.sun.com/software/solaris/";
            $title['osName'] = "Solaris";
            $code = "solaris";
        } elseif (preg_match('/Symb(ian)?(OS)?/i', $userAgentString)) {
            $link = "http://www.symbianos.org/";
            $title = "SymbianOS";
            if (preg_match('/Symb(ian)?(OS)?\/([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
                $title['osName'] .= " " . $regmatch[3];
            }
            $code = "symbian";
        } elseif (preg_match('/Unix/i', $userAgentString)) {
            $link = "http://www.unix.org/";
            $title['osName'] = "Unix";
            $code = "unix";
            // @codeCoverageIgnoreStart
        } elseif (preg_match('/webOS/i', $userAgentString)) {
            $link = "http://en.wikipedia.org/wiki/WebOS";
            $title['osName'] = "Palm webOS";
            $code = "palm";
        } elseif (preg_match('/J2ME\/MIDP/i', $userAgentString)) {
            $link = "http://java.sun.com/javame/";
            $title['osName'] = "J2ME/MIDP Device";
            $code = "java";
        } else {
            $code = "null";
        }

        return $title;
    }
}