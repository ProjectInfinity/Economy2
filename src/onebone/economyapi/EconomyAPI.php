<?php

namespace onebone\economyapi;

use Leet\Economy2\Economy2;
use Leet\Economy2\event\money\AlterMoneyEvent;
use pocketmine\Player;

/**
 * This class is a dummy class in order
 * for plugins written for Economy by onebone
 * to work with Economy2.
 *
 * It is HIGHLY recommended to use Economy2 plugins as
 * opposed to legacy plugins for Economy by onebone.
 */

class EconomyAPI {

    /** Irrelevant stuff that EconomyAPI insists on having. */
    const API_VERSION = 1;
    const PACKAGE_VERSION = "5.6";
    const RET_CANCELLED = -2;
    const RET_ERROR_1 = -4;
    const RET_ERROR_2 = -3;
    const RET_INVALID = 0;
    const RET_NOT_FOUND = -1;
    const RET_SUCCESS = 1;
    const CURRENT_DATABASE_VERSION = 0x02;
    /** End of irrelevant stuff that EconomyAPI insists on having. */

    private static $fakePlugin;
    private $plugin, $moneyHandler;

    public function __construct() {
        self::$fakePlugin = $this;
        $this->plugin = Economy2::getPlugin();
        $this->moneyHandler = $this->plugin->getMoneyHandler();
    }

    public static function getInstance() {
        return self::$fakePlugin;
    }

    public function accountExists($player) {
        if($player instanceof Player){
            $player = $player->getName();
        }
        $player = strtolower($player);

        return $this->moneyHandler->playerExists($player);
    }

    public function addMoney($player, $amount, $force = false, $issuer = 'external') {
        if($amount <= 0 or !is_numeric($amount)){
            return self::RET_INVALID;
        }

        if($player instanceof Player){
            $player = $player->getName();
        }
        $player = strtolower($player);

        if(!$this->moneyHandler->alterBalance($player, $amount)) return self::RET_CANCELLED;
        $this->plugin->getServer()->getPluginManager()->callEvent(new AlterMoneyEvent($this->plugin, $issuer, $player, $amount, true));

        return self::RET_SUCCESS;
    }

    public function createAccount($player, $default_money = false, $force = false) {
        if($player instanceof Player){
            $player = $player->getName();
        }
        $player = strtolower($player);
        $this->moneyHandler->createPlayer($player, ($default_money ? $this->moneyHandler->getStartBalance() : 0.00));
    }

    public function getAllMoney() {
        return $this->moneyHandler->getBalanceAll();
    }

    public function getMonetaryUnit() {
        return $this->moneyHandler->getSymbol();
    }

    public function myMoney($player) {
        if($player instanceof Player){
            $player = $player->getName();
        }
        $player = strtolower($player);

        return $this->moneyHandler->getBalance($player, true);
    }

    public function reduceMoney($player, $amount, $force = false, $issuer = 'external') {
        if($amount <= 0 or !is_numeric($amount)){
            return self::RET_INVALID;
        }

        if($player instanceof Player){
            $player = $player->getName();
        }
        $player = strtolower($player);

        if(!$this->moneyHandler->alterBalance($player, -$amount)) return self::RET_CANCELLED;

        $this->plugin->getServer()->getPluginManager()->callEvent(new AlterMoneyEvent($this->plugin, $issuer, $player, $amount, false));

        return self::RET_SUCCESS;

    }

    public function removeAccount($player) {
        return false;
    }

}