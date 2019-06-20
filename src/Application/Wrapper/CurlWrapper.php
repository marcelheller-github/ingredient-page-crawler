<?php

declare(strict_types=1);

namespace SocialFood\Application\Wrapper;

class CurlWrapper
{
    /**
     * @param string $url
     * @return resource | bool
     */
    public function init(string $url = null)
    {
        return curl_init($url);
    }

    public function setOpt($curlHandle, int $option, $value): bool
    {
        return curl_setopt($curlHandle, $option, $value);
    }

    public function exec($curlHandle)
    {
        return curl_exec($curlHandle);
    }

    public function close($curlHandle)
    {
        return curl_close($curlHandle);
    }
}
