<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class ClientTest extends PHPUnit_Framework_TestCase
{
    public function testClientEndpoint()
    {
        $client = new PomeloPHP\Client('foo', 'bar');

        $this->assertEquals(
            $client::POMELO_PRODUCTION_ENDPOINT,
            PHPUnit_Framework_Assert::readAttribute($client, "baseUrl")
        );

        $client = new PomeloPHP\Client('foo', 'bar', 'sandbox');

        $this->assertEquals(
            $client::POMELO_SANDBOX_ENDPOINT,
            PHPUnit_Framework_Assert::readAttribute($client, "baseUrl")
        );

    }

    public function testHeaders()
    {
        $mock = new MockHandler([new Response(200, ['X-Foo' => 'Bar'], "{\"foo\":\"bar\"}")]);
        $container = [];
        $history = Middleware::history($container);
        $stack = HandlerStack::create($mock);
        $stack->push($history);
        $http_client = new Client(['handler' => $stack]);
        $client = new PomeloPHP\Client('foo' , 'bar');
        $client->setClient($http_client);

        $client->transactions->all();

        foreach ($container as $transaction) {
           $this->assertEquals('GET', $transaction['request']->getMethod());
        }
    }

    public function testGet()
    {
        $mock = new MockHandler([new Response(200, ['X-Foo' => 'Bar'], "{\"foo\":\"bar\"}")]);
        $container = [];
        $history = Middleware::history($container);
        $stack = HandlerStack::create($mock);
        $stack->push($history);
        $http_client = new Client(['handler' => $stack]);
        $client = new PomeloPHP\Client('foo' , 'bar');
        $client->setClient($http_client);

        $client->transactions->get('foo');

        foreach ($container as $transaction) {
            $this->assertEquals('GET', $transaction['request']->getMethod());
        }
    }

    public function testPost()
    {
        $mock = new MockHandler([new Response(200, ['X-Foo' => 'Bar'], "{\"foo\":\"bar\"}")]);
        $container = [];
        $history = Middleware::history($container);
        $stack = HandlerStack::create($mock);
        $stack->push($history);
        $http_client = new Client(['handler' => $stack]);
        $client = new PomeloPHP\Client('foo' , 'bar');
        $client->setClient($http_client);

        $client->transactions->create(['foo' => 'bar']);

        foreach ($container as $transaction) {
            $this->assertEquals('POST', $transaction['request']->getMethod());
        }
    }

}
