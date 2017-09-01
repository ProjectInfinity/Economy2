<?php

namespace ProjectInfinity\Economy2\event\money;

use ProjectInfinity\Economy2\Economy2;
use ProjectInfinity\Economy2\event\Economy2Event;

class AlterMoneyEvent extends Economy2Event {

    private $username, $amount, $type;

    public static $handlerList;

    public function __construct(Economy2 $plugin, $issuer, $username, $amount, $type) {
        parent::__construct($plugin, $issuer);
        $this->username = $username;
        $this->amount = $amount;
        $this->type = $type;
    }

    /**
     * Returns the username of the player that had their
     * balance altered.
     *
     * @return String
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Returns the amount of money the player had their
     * balance altered.
     *
     * @return Float
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * Returns a bool representing a negative or positive alteration
     * of the balance.
     *
     * @return bool
     */
    public function getType() {
        return $this->type;
    }
}