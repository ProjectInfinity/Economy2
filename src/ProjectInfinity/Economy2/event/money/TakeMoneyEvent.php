<?php

namespace ProjectInfinity\Economy2\event\money;

use ProjectInfinity\Economy2\Economy2;
use ProjectInfinity\Economy2\event\Economy2Event;

class TakeMoneyEvent extends Economy2Event {

    private $username, $amount;

    public static $handlerList;

    public function __construct(Economy2 $plugin, $issuer, $username, $amount) {
        parent::__construct($plugin, $issuer);
        $this->username = $username;
        $this->amount = $amount;
    }

    /**
     * Returns the username of the player that had their
     * balance set.
     *
     * @return String
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Returns the amount of money taken
     * from the player.
     *
     * @return integer|float
     */
    public function getAmount() {
        return $this->amount;
    }

}