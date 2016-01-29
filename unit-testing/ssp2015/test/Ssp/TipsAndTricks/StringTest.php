<?php

namespace Ssp\TipsAndTricks;

class StringTest extends \PHPUnit_Framework_TestCase
{
    public function reversibleStringProvider()
    {
        /*
         * One outer array consisting of several inner arrays.
         *
         * Each element of the inner arrays is a parameter that will be passed to the test method.
         */
        return [
            ['foo', 'oof'],       // $text = 'foo', $expected = 'oof'
            ['bar', 'rab'],       // $text = 'bar', $expected = 'rab'
            ['foobar', 'raboof'], // $text = 'foobar', $expected = 'raboof'
        ];
    }

    /**
     * @dataProvider reversibleStringProvider
     *
     * @param string $text The text to reverse
     * @param string $expected The expected reversal
     */
    public function testCanReverseStrings($text, $expected)
    {
        $string = new String($text);
        $this->assertSame($expected, $string->reverse());
    }
}
