<?php

namespace Ssp\TestingInIsolation;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
use Mockery as m;

class WeatherServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testCanGetTemperatureReallySlowlyAndBrittly()
    {
        $this->markTestSkipped('<--- Comment out this line to watch this test fail gloriously!');

        // If we're testing against a real API, we have no way to know what value to expect.
        $expectedTemperature = 'How am I supposed to know?';

        // Real cache and real HTTP client means our test fails if either is offline... even if the code is correct!
        $weatherService = new WeatherService(new \Memcached(), new Client());
        $currentTemperature = $weatherService->getTemperature('Miami, FL');

        $this->assertSame($expectedTemperature, $currentTemperature);
    }

    public function testReturnsTemperatureIfFoundInCache()
    {
        $expectedTemperature = '90F';

        // The cache will behave exactly as we told it, and complain if anything unexpected happens.
        $cache = $this->getMockBuilder('Memcached')
            ->setMethods(['get'])
            ->getMock();
        $cache->expects($this->once())
            ->method('get')
            ->with(md5('Miami, FL'))
            ->will($this->returnValue(['temperature' => $expectedTemperature]));

        $weatherService = new WeatherService($cache, new Client());
        $currentTemperature = $weatherService->getTemperature('Miami, FL');

        $this->assertSame($expectedTemperature, $currentTemperature);
    }

    public function testRetrievesTemperatureFromApiIfNotFoundInCache()
    {
        $expectedTemperature = '90F';
        $expectedCacheKey = md5('Miami, FL');
        $temperatureData = ['temperature' => '90F'];

        // Use Mockery for our mocks this time.
        $cache = m::mock('Memcached');
        $cache->shouldReceive('get')
            ->once()
            ->with($expectedCacheKey)
            ->andReturn(null);
        $cache->shouldReceive('set')
            ->once()
            ->with($expectedCacheKey, $temperatureData, 900);
        $httpClient = m::mock('GuzzleHttp\Client');
        $httpClient->shouldReceive('get')
            ->once()
            ->with('https://some-weather-api.com/temperature/' . urlencode('Miami, FL'))
            ->andReturn(new Response(200, [], Stream::factory(json_encode($temperatureData))));

        $weatherService = new WeatherService($cache, $httpClient);
        $currentTemperature = $weatherService->getTemperature('Miami, FL');

        $this->assertSame($expectedTemperature, $currentTemperature);
    }
}
