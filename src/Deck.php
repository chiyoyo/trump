<?php
namespace Trump;

use Trump\Exception\EndOfDeckException;

class Deck
{
    /** @var DeckOption オプション */
    protected $option;
    /** @var array<Card> 残りカード */
    protected $cards = [];
    /** @var array<Card> 引いたカード */
    protected $pile = [];

    /**
     * Constructor
     *
     * @param DeckOption $option
     */
    public function __construct(DeckOption $option)
    {
        $this->option = $option;
        $this->cards = [];

        // Add normal cards
        foreach (Card::CARDS as $code) {
            for ($i = 0 ; $i < $option->getDeckCount() ; $i++) {
                $this->cards[] = new Card($code);
            }
        }

        // Add jokers
        if ($option->getJokers()) {
            for ($i = 0 ; $i < $option->getDeckCount() ; $i++) {
                foreach (Card::JOKERS as $code) {
                    $this->cards[] = new Card($code);
                }
            }
        }

        // Shuffle
        if ($option->getShuffled()) {
            $this->shuffle();
        }
    }

    /**
     * Shuffle the remaining cards
     *
     * @return void
     */
    public function shuffle()
    {
        shuffle($this->cards);
    }

    /**
     * Get card
     *
     * @return Card
     */
    public function draw()
    {
        if (count($this->cards) == 0) {
            throw new EndOfDeckException();
        }
        $card = array_shift($this->cards);
        $this->pile[] = $card;
        return $card;
    }

    /**
     * Get number of card remaining
     *
     * @return integer
     */
    public function remain(): int
    {
        return count($this->cards);
    }

    /**
     * Display for debug
     *
     * @return void
     */
    public function display()
    {
        echo 'CARDS:';
        foreach ($this->cards as $card) {
            echo $card->getCode() . ',';
        }
        echo PHP_EOL;

        echo 'PILE:';
        foreach ($this->pile as $pile) {
            echo $pile->getCode() . ',';
        }
        echo PHP_EOL;
    }
}