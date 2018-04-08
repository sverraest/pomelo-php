<?php

class TransactionsTest extends PHPUnit_Framework_TestCase
{
    public function testAll()
    {
        $stub = $this->getMockBuilder('PomeloPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');

        $transactions = new \PomeloPHP\Transactions($stub);
        $this->assertEquals('foo', $transactions->all());

    }

    public function testGet()
    {
        $stub = $this->getMockBuilder('PomeloPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');

        $transactions = new \PomeloPHP\Transactions($stub);
        $this->assertEquals('foo', $transactions->get('bar'));

    }

    public function testCreate()
    {
        $stub = $this->getMockBuilder('PomeloPHP\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');

        $transactions = new \PomeloPHP\Transactions($stub);
        $this->assertEquals('foo', $transactions->create(['foo' => 'bar']));

    }
}

