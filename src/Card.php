<?php
namespace Trump;

use Trump\Exception\InvalidCardPropertyException;

/**
 * Card class
 */
class Card extends GenericCard
{
    const SUIT_SPADE = 'SPADES';
    const SUIT_DIAMOND = 'DIAMONDS';
    const SUIT_CLUB = 'CLUBS';
    const SUIT_HEART = 'HEARTS';
    const SUIT_JOKER = 'JOKER';

    const SUIT_SHORT_SPADE = 'S';
    const SUIT_SHORT_DIAMOND = 'D';
    const SUIT_SHORT_CLUB = 'C';
    const SUIT_SHORT_HEART = 'H';
    const SUIT_SHORT_JOKER = 'X';

    const COLOR_RED = 'RED';
    const COLOR_BLACK = 'BLACK';

    // All card list
    const CARDS = [
        'AS', '2S', '3S', '4S', '5S', '6S', '7S', '8S', '9S', '0S', 'JS', 'QS', 'KS',
        'AD', '2D', '3D', '4D', '5D', '6D', '7D', '8D', '9D', '0D', 'JD', 'QD', 'KD',
        'AC', '2C', '3C', '4C', '5C', '6C', '7C', '8C', '9C', '0C', 'JC', 'QC', 'KC',
        'AH', '2H', '3H', '4H', '5H', '6H', '7H', '8H', '9H', '0H', 'JH', 'QH', 'KH',
    ];
    const JOKERS = ['X1', 'X2'];
    // SUITS = {'S': 'SPADES', 'D': 'DIAMONDS', 'H': 'HEARTS', 'C': 'CLUBS', '1': 'BLACK', '2': 'RED'}
    const VALUES = [
        'A' => 'ACE',
        'J' => 'JACK',
        'Q' => 'QUEEN',
        'K' => 'KING',
        '0' => '10',
        'X' => 'JOKER',
    ];
    
    const SUITS = [
        self::SUIT_SHORT_CLUB => [
            'name' => self::SUIT_CLUB,
            'code'  => 'C',
            'color' => self::COLOR_BLACK,
        ],
        self::SUIT_SHORT_SPADE => [
            'name' => self::SUIT_SPADE,
            'code'  => 'S',
            'color' => self::COLOR_BLACK,
        ],
        self::SUIT_SHORT_HEART => [
            'name' => self::SUIT_HEART,
            'code'  => 'H',
            'color' => self::COLOR_RED,
        ],
        self::SUIT_SHORT_DIAMOND => [
            'name' => self::SUIT_DIAMOND,
            'code'  => 'D',
            'color' => self::COLOR_RED,
        ],
    ];

    // Properties
    protected $code = '';
    protected $suit = [];

    /**
     * Initialize a card
     *
     * @param string $code
     */
    public function __construct($code)
    {
        $this->setCode($code);
    }

    public function setCode($code)
    {
        $code = strtoupper($code);
        if (!in_array($code, self::CARDS) && !in_array($code, self::JOKERS)) {
            throw new InvalidCardPropertyException('An invalid code was set for a card: ' . $code);
        }
        $this->code = $code;

        if (in_array($code, self::CARDS)) {
            $idx = array_search($code, self::CARDS);
            $this->value = $idx % 13 + 1;
            $this->suit = self::SUITS[$code[1]];
        } elseif (in_array($code, self::JOKERS)) {
            $this->suit = [
                'name' => self::SUIT_JOKER,
                'code'  => 'X',
                'color' => null,
            ];
        }
    }

    /**
     * Get the suit information of this card
     *
     * @return array
     */
    public function getSuitInfo(): array
    {
        return $this->suit;
    }

    /**
     * Get the suit of this card
     *
     * @return string
     */
    public function getSuit(): string
    {
        return $this->suit['name'];
    }

    /**
     * Get the number of this card
     *
     * @return integer|null
     */
    public function getNumber(): int|null
    {
        return $this->value;
    }

    /**
     * Get the color of this card
     *
     * @return string|null
     */
    public function getColor(): string
    {
        return $this->suit['color'];
    }

    /**
     * Get shortened card's suit and number
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Get joker or not
     *
     * @return boolean
     */
    public function isJoker(): bool
    {
        return in_array($this->code, self::JOKERS);
    }
}
