<?php

use Trump\Card;
use Trump\Exception\InvalidCardPropertyException;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    /**
     * @dataProvider initDataProvider
     */
    public function testInit($summary, $suit, $number, $code)
    {
        $sm = explode(':', $summary, 2);

        if ($sm[0] === 'Exception') {
            $this->expectException(InvalidCardPropertyException::class);
        }
        
        $card = new Card($code);

        if ($sm[0] === 'Success') {
            $this->assertSame($suit, $card->getSuit());
            $this->assertSame($number, $card->getNumber());
        }
    }

    public static function initDataProvider()
    {
        $data = [
            'Success: Spade 1'      => ['SPADES', 1, 'AS'],
            'Success: Heart 13'     => ['HEARTS', 13, 'KH'],
            'Success: Joker'        => ['JOKER', null, 'X1'],
            'Success: Joker+number' => ['JOKER', null, 'X2'],
            'Exception: no suit'    => ['', 0, 'exception'],
        ];

        return array_map(function ($key, $item) {
            return array_merge([$key], $item);
        }, array_keys($data), $data);
    }
}
