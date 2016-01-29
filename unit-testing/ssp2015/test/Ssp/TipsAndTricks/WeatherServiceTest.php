<?php

namespace Ssp\TipsAndTricks;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
use Mockery as m;
use Ssp\TestingInIsolation\WeatherService;

class WeatherServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Memcached|\Mockery\Mock
     */
    protected $cache;

    /**
     * @var Client|\Mockery\Mock
     */
    protected $httpClient;

    /**
     * @var WeatherService
     */
    protected $weatherService;

    public function testReturnsTemperatureIfFoundInCache()
    {
        $city = 'Miami, FL';
        $expectedTemperature = '90F';
        $this->cache->shouldReceive('get')
            ->once()
            ->with(md5($city))
            ->andReturn(['temperature' => $expectedTemperature]);

        $this->assertSame($expectedTemperature, $this->weatherService->getTemperature($city));
    }

    public function testRetrievesTemperatureFromApiIfNotFoundInCache()
    {
        $city = 'Miami, FL';
        $expectedTemperature = '90F';
        $expectedCacheKey = md5($city);
        $temperatureData = ['temperature' => $expectedTemperature];

        $this->cache->shouldReceive('get')
            ->once()
            ->with($expectedCacheKey)
            ->andReturn(null);
        $this->cache->shouldReceive('set')
            ->once()
            ->with($expectedCacheKey, $temperatureData, 900);
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('https://some-weather-api.com/temperature/' . urlencode($city))
            ->andReturn(new Response(200, [], Stream::factory(json_encode($temperatureData))));

        $this->assertSame($expectedTemperature, $this->weatherService->getTemperature($city));
    }

    /**
     * Whatever you put in here will be executed before *every* test.
     */
    protected function setUp()
    {
        $this->cache = m::mock('Memcached');
        $this->httpClient = m::mock('GuzzleHttp\Client');
        $this->weatherService = new WeatherService($this->cache, $this->httpClient);
    }

    /**
     * Whatever you put in here will be executed after *every* test.
     */
    protected function tearDown()
    {
        $this->weatherService = null;
        $this->cache = null;
        $this->httpClient = null;
    }

    /**
     * Whatever you put in here will be executed *once* before any tests for this class are run.
     *
     * Note that this method needs to be static!
     */
    public static function setUpBeforeClass()
    {
        // Just an example. Put something useful here, or nothing at all. :)
        // echo "\nWelcome to the WeatherService tests!\n";
    }

    /**
     * Whatever you put in here will be executed *once* after all the tests have run.
     *
     * Note that this method needs to be static!
     */
    public static function tearDownAfterClass()
    {
        // Just an example. Put something useful here, or nothing at all. :)
        // echo "\nYou are now leaving the WeatherService tests!\n";
    }
}
