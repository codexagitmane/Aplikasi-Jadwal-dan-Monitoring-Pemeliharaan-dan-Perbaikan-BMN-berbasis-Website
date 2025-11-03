<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    public string $baseURL = 'http://localhost:8080/';

    public string $indexPage = '';

    public string $uriProtocol = 'REQUEST_URI';

    public string $defaultLocale = 'id';

    public array $supportedLocales = ['id'];

    public string $appTimezone = 'Asia/Jakarta';

    public string $charset = 'UTF-8';

    public bool $forceGlobalSecureRequests = false;

    public array $proxyIPs = [];

    public bool $CSPEnabled = false;

    public string $CSRFTokenName   = 'csrf_test_name';
    public string $CSRFHeaderName  = 'X-CSRF-TOKEN';
    public string $CSRFCookieName  = 'csrf_cookie_name';
    public int $CSRFExpiration     = 7200;
    public bool $CSRFRegenerate    = true;
    public bool $CSRFRedirect      = true;
    public string $CSRFSameSite    = 'Lax';

    public string $cookiePrefix   = '';
    public string $cookieDomain   = '';
    public string $cookiePath     = '/';
    public string $cookieSameSite = 'Lax';
    public bool $cookieSecure     = false;
    public bool $cookieHTTPOnly   = true;

    public string $sessionDriver            = 'CodeIgniter\\Session\\Handlers\\FileHandler';
    public string $sessionCookieName        = 'ci_session';
    public string $sessionSavePath          = WRITEPATH . 'session';
    public int $sessionExpiration           = 7200;
    public int $sessionMatchIP              = 0;
    public bool $sessionRegenerateDestroy   = false;
    public int $sessionTimeToUpdate         = 300;

    public string $appName = 'Sistem Jadwal & Monitoring BMN';
}
