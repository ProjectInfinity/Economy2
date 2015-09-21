<?php

namespace Leet\Economy2\event\money;

use Leet\Economy2\Economy2;
use Leet\Economy2\event\Economy2Event;

class GiveMoneyEvent extends Economy2Event {

    private $username, $amount;

    public static $handlerList;

    public function __construct(Economy2 $plugin, $issuer, $username, $amount) {
        parent::__construct($plugin, $issuer);
        $this->username = $username;
        $this->amount = $amount;
    }

    /**
     * Returns the username of the player that was
     * given money.
     *
     * @return String
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Returns the amount of money that was
     * given to the player.
     *
     * @return Float
     */
    public function getAmount() {
        return $this->amount;
    }

}