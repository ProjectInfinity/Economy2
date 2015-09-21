<?php

namespace Leet\Economy2\event\money;

use Leet\Economy2\Economy2;
use Leet\Economy2\event\Economy2Event;

class SetMoneyEvent extends Economy2Event {

    private $username, $balance;

    public static $handlerList;

    public function __construct(Economy2 $plugin, $issuer, $username, $balance) {
        parent::__construct($plugin, $issuer);
        $this->username = $username;
        $this->balance = $balance;
    }

    /**
     * Returns the new balance for the player whom had
     * their balance set.
     * @return integer|float
     */
    public function getBalance() {
        return $this->balance;
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

}