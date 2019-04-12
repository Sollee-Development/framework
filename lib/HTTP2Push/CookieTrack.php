<?php

namespace HTTP2Push;

class CookieTrack {
    private $cacheAware;
    private $cookieName;

    public function __construct(CacheAware $cacheAware, $cookieName = 'http2push') {
        $this->cacheAware = $cacheAware;
        $this->cookieName = $cookieName;
    }

    public function sendHeader() {
        // read the cookie, if it's not set, use 0 to force push
        $lastDownloadTime = $_COOKIE[$this->cookieName] ?? 0;

        // Get the link header. This will either be the HTTP header or an empty string depending on $lastDownloadTime
        $header = $this->cacheAware->getHeader($lastDownloadTime);

        if ($header !== '') {
            // If there are files to be pushed, set the cookie to log the download time
            setcookie('http2push', time());
            // Then send the header
            header($header);
        }
    }
}