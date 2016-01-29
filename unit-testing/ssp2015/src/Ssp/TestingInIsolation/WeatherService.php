<?php

namespace Ssp\TestingInIsolation;

use GuzzleHttp\Client as HttpClient;
use Memcached;

class WeatherService
{
    /**
     * How the temperature should be cached before looking it up again
     */
    const TEMPERATURE_CACHE_TTL = 900;

    /**
     * @var Memcached
     */
    protected $cache;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * Constructor
     *
     * @param Memcached $cache
     * @param HttpClient $httpClient
     */
    public function __construct(Memcached $cache, HttpClient $httpClient)
    {
        $this->cache = $cache;
        $this->httpClient = $httpClient;
    }

    /**
     * Returns the current temperature in the specified city from the cache if
     * it exists. Otherwise, will retrieve it from the API and cache the result.
     *
     * @param string $city
     * @return string
     */
    public function getTemperature($city)
    {
        $cacheKey = md5($city);
        $weatherData = $this->cache->get($cacheKey);

        if (!$weatherData) {
            $weatherData = $this->httpClient->get(
                'https://some-weather-api.com/temperature/' . urlencode($city)
            )->json();
            $this->cache->set($cacheKey, $weatherData, self::TEMPERATURE_CACHE_TTL);
        }

        return $weatherData['temperature'];
    }
}
