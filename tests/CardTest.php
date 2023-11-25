<?php

use Trump\Card;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    /**
     * @dataProvider initDataProvider
     */
    public function testInit($summary, $suit, $number, $result)
    {
        $card = new Card($suit, $number);
        $this->assertSame($result, $card->getCode());
    }

    public static function initDataProvider()
    {
        $data = [
            'Spade 1'      => ['spade', 1, 's1'],
            'Heart 13'     => ['heart', 13, 'hd'],
            'Joker'        => ['joker', null, 'j'],
            'Joker+number' => ['joker', 1, 'j'],
        ];

        return array_map(function ($key, $item) {
            return array_merge([$key], $item);
        }, array_keys($data), $data);
    }
}
