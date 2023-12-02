<?php

use Trump\Deck;
use Trump\DeckOption;
use Trump\Exception\InvalidCardPropertyException;
use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase
{
    /**
     * @dataProvider initDataProvider
     */
    public function testInit($summary, $options, $result)
    {
        $sm = explode(':', $summary, 2);

        if ($sm[0] === 'Exception') {
            $this->expectException(InvalidCardPropertyException::class);
        }
        $option = new DeckOption($options);
        $deck = new Deck($option);

        if ($sm[0] === 'Success') {
            $this->assertSame($deck->remain(), $result);
        }
    }

    public static function initDataProvider()
    {
        $data = [
            'Success: default' => [[], 52],
            'Success: jokers' => [['jokers' => true], 54],
        ];

        return array_map(function ($key, $item) {
            return array_merge([$key], $item);
        }, array_keys($data), $data);
    }
}
