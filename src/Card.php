<?php
namespace Trump;

use Trump\Exception\InvalidCardPropertyException;

/**
 * Card class
 */
class Card extends GenericCard
{
    const SUIT_CLUB = 'club';
    const SUIT_HEART = 'heart';
    const SUIT_SPADE = 'spade';
    const SUIT_DIAMOND = 'diamond';
    const SUIT_JOKER = 'joker';

    const COLOR_RED = 'red';
    const COLOR_BLACK = 'black';

    protected $suits = [
        self::SUIT_CLUB => [
            'name'       => 'Club',
            'short_name' => 'c',
            'color'      => self::COLOR_BLACK,
        ],
        self::SUIT_SPADE => [
            'name'       => 'Spade',
            'short_name' => 's',
            'color'      => self::COLOR_BLACK,
        ],
        self::SUIT_HEART => [
            'name'       => 'Heart',
            'short_name' => 'h',
            'color'      => self::COLOR_RED,
        ],
        self::SUIT_DIAMOND => [
            'name'       => 'Diamond',
            'short_name' => 'd',
            'color'      => self::COLOR_RED,
        ],
        self::SUIT_JOKER => [
            'name'       => 'Joker',
            'short_name' => 'j',
            'color'      => null,
        ],
    ];

    //
    protected $suit = '';
    protected $number = null;

    /**
     * Initialize a card
     *
     * @param string $suit
     * @param int|null $number
     */
    public function __construct($suit, $number = null)
    {
        $this->setSuit($suit);
        $this->setNumber($number);
    }

    /**
     * Get the suit of this card
     *
     * @return string
     */
    public function getSuit(): string
    {
        return $this->suits[$this->suit]['name'];
    }

    /**
     * Get the short name of this card's suit
     *
     * @return string|null
     */
    public function getShortSuit(): string|null
    {
        return $this->suits[$this->suit]['short_name'];
    }

    /**
     * Get the number of this card
     *
     * @return integer
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * Get the color of this card
     *
     * @return string|null
     */
    public function getColor(): string
    {
        return $this->suits[$this->suit]['color'];
    }

    /**
     * Get shortened card's suit and number
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->getShortSuit() . ($this->isJoker() ? '' : dechex($this->getNumber()));
    }

    /**
     * Get joker or not
     *
     * @return boolean
     */
    public function isJoker(): bool
    {
        return $this->suit === self::SUIT_JOKER;
    }

    /**
     * Set the suit of this card
     *
     * @param string $suit
     * @return void
     */
    public function setSuit($suit): void
    {
        if (! $this->isValidSuit($suit)) {
            throw new InvalidCardPropertyException('An invalid suit was set for a card: ' . $suit);
        }

        $this->suit = $suit;
    }

    /**
     * Set the number of this card
     *
     * @param int $number
     * @return void
     */
    public function setNumber($number): void
    {
        if (! $this->isValidNumber($number)) {
            throw new InvalidCardPropertyException('An invalid number was set for a card: ' . $number);
        }

        if (! $this->isJoker()) {
            $this->number = $number;
        }
    }

    /**
     * Checks if the provided suit is valid
     *
     * @param string $suit
     * @return boolean
     */
    protected function isValidSuit($suit): bool
    {
        if (is_null($suit)) {
            return false;
        }
        return array_key_exists($suit, $this->suits);
    }

    /**
     * Checks if the provided number is valid
     *
     * @param int $number
     * @return boolean
     */
    protected function isValidNumber($number): bool
    {
        if ($this->isJoker()) {
            return true;
        }
        if (is_null($number)) {
            return false;
        }
        return $number >= 1 && $number <= 13;
    }
}
