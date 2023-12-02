<?php
namespace Trump;

use Trump\Exception\InvalidDeckOptionException;

class DeckOption
{
    const MAX_DECK_COUNT = 20;

    /** @var integer 52枚のカード何セット使うか */
    protected $deckCount = 1;
    /** @var bool シャッフルするか */
    protected $shuffled = true;
    /** @var bool ジョーカーを含むか */
    protected $jokers = false;

    public function __construct($options = [])
    {
        if (isset($options['deckCount'])) {
            $this->setDeckCount($options['deckCount']);
        }
        if (isset($options['shuffled'])) {
            $this->setShuffled($options['shuffled']);
        }
        if (isset($options['jokers'])) {
            $this->setJokers($options['jokers']);
        }
    }

    /**
     * 52枚のカード何セットで1デッキとするか
     *
     * @return integer
     */
    public function getDeckCount(): int
    {
        return $this->deckCount;
    }

    public function setDeckCount(int $count)
    {
        if ($count <= 0 || $count > self::MAX_DECK_COUNT) {
            throw new InvalidDeckOptionException('The number of decks must be between 1 and 20: ' . $count);
        }
        $this->deckCount = $count;
    }

    public function getShuffled(): bool
    {
        return $this->shuffled;
    }

    public function setShuffled(bool $shuffled)
    {
        $this->shuffled = $shuffled;
    }

    public function getJokers(): bool
    {
        return $this->jokers;
    }

    public function setJokers(bool $jokers)
    {
        $this->jokers = $jokers;
    }
}