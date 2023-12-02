<?php
namespace Trump;

use Trump\Exception\EndOfDeckException;

class Deck
{
    protected $options = [
        'joker' => 0,
        'count' => 1,
    ];
    /** @var array<Card> 残りカード */
    protected $cards = [];
    /** @var array<Card> 引いたカード */
    protected $pile = [];

    public function __construct(DeckOption $option)
    {
        $this->cards = [];
        for ($i = 0 ; $i < $option->getDeckCount() ; $i++) {
            foreach (Card::CARDS as $code) {
                $this->cards[] = new Card($code);
            }
            if ($option->getJokers()) {
                foreach (Card::JOKERS as $code) {
                    $this->cards[] = new Card($code);
                }
            }
        }
        if ($option->getShuffled()) {
            $this->shuffle();
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function shuffle()
    {
        shuffle($this->cards);
    }

    /**
     * カードを取得する
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
     * 残り枚数を取得
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