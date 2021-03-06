<?php

namespace Appstract\Opcache;

use Illuminate\Support\Facades\Crypt as Crypt;
use Illuminate\Support\Facades\Http;

trait CreatesRequest
{
    /**
     * @param $url
     * @param $parameters
     * @return \Appstract\LushHttp\Response\LushResponse
     */
    public function sendRequest($url, $parameters = [])
    {
        return Http::withHeaders(config('opcache.headers'))
            ->withOptions(['verify' => config('opcache.verify')])
            ->get(config('opcache.url').'/'.config('opcache.prefix').'/'.$url,
                array_merge(['key' => Crypt::encrypt('opcache')], $parameters)
        );
    }
}
