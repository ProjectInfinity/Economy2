<?php

namespace Leet\Economy2\util;

use Leet\Economy2\Economy2;
use pocketmine\utils\Config;

class MoneyHandler {

    private $plugin;
    private $data;
    private $currencySymbol, $currencySingle, $currencyPlural, $startBalance;

    public function __construct(Economy2 $plugin) {
        $this->plugin = $plugin;
        $this->data = new Config($plugin->getDataFolder().'money.yml', Config::YAML);
        $this->currencySymbol = $plugin->getConfig()->getNested('currency.symbol');
        $this->currencySingle = $plugin->getConfig()->getNested('currency.single');
        $this->currencyPlural = $plugin->getConfig()->getNested('currency.plural');
        $this->startBalance = $plugin->getConfig()->getNested('currency.start-balance', 100.00);
    }

    /**
     * Returns the balance of the player.
     *
     * @param $player
     * @param $create
     * @return float|int|null
     */
    public function getBalance($player, $create = false) {

        $player = strtolower($player);

        $p = $this->data->getNested('balance.'.$player, null);

        # Check if the player exists.
        if($p === null) {
            # Return null if we do not want to create an account.
            if(!$create) return null;
            $this->createPlayer($player, $this->startBalance);
            $p = $this->data->getNested('balance.'.$player, null);
            # Check if the player still does not exist.
            if($p === null) {
                $this->plugin->getLogger()->error('Failed to create Economy2 data for '.$player);
                return null;
            }
        }

        if(!is_float($p) AND !is_int($p)) {
            $this->plugin->getLogger()->error('The balance for '.$player.' is not a float or a integer');
            return null;
        }

        return $p;

    }

    /**
     * Sets the balance of the player.
     *
     * @param $player
     * @param $balance
     * @return bool|null
     */
    public function setBalance($player, $balance) {

        $player = strtolower($player);

        $p = $this->data->getNested('balance.'.$player, null);

        if(!is_float($balance)) {
            if(!is_int($balance)) {
                $this->plugin->getLogger()->error('Provided balance is not a float');
                return null;
            }
            $balance = floatval($balance);
        }

        # Check if the player exists.
        if($p === null) {
            $this->createPlayer($player);
            $p = $this->data->getNested('balance.'.$player, null);
            # Check if the player still does not exist.
            if($p === null) {
                $this->plugin->getLogger()->error('Failed to create Economy2 data for '.$player);
                return null;
            }
        }

        $this->data->setNested('balance.'.$player, $balance);

        $this->save();

        return $this->data->getNested('balance.'.$player) == $p;

    }

    /**
     * Alters the balance of the player.
     *
     * @param $player
     * @param $balance
     * @return bool
     */
    public function alterBalance($player, $balance) {

        # Just for the sake of consistency.
        if(is_int($balance)) $balance = floatval($balance);

        if(!is_float($balance)) {
            $this->plugin->getLogger()->error('Could not alter balance for '.$player.', '.$balance.' is not a float');
            return false;
        }

        $player = strtolower($player);

        # Just return if the balance is 0.
        if($balance == 0) return false;

        $p = $this->getBalance($player);

        # Player does not exist and could not be created.
        if($p === null) return false;

        # Player cannot afford it.
        if($balance < 0) {
            if(($p - $balance) < 0) return false;
        }

        $this->data->setNested('balance.'.$player, ($balance > 0) ? $p + $balance : $p - abs($balance));

        $this->save();

        return $this->data->getNested('balance'.$player) !== $p;

    }

    /**
     * Creates a player with the specified balance.
     *
     * @param $player
     * @param float $balance
     * @param bool $saveNow
     */
    public function createPlayer($player, $balance = 0.00, $saveNow = true) {

        # Validate the data.
        if(!is_float($balance)) {
            if(is_int($balance)) {
                $balance = floatval($balance);
            } else {
                $balance = 0;
            }
        }

        $this->data->setNested('balance.'.strtolower($player), $balance);

        if($saveNow) $this->save();

    }

    /**
     * Returns the symbol representing the currency.
     *
     * @return String
     */
    public function getSymbol() {
        return $this->currencySymbol;
    }

    /**
     * Returns the name of the currency in it's singular form.
     *
     * @return String
     */
    public function getSingularName() {
        return $this->currencySingle;
    }

    /**
     * Returns the name of the currency in it's plural form.
     *
     * @return String
     */
    public function getPluralName() {
        return $this->currencyPlural;
    }

    /**
     * Attempts to find clues whether a player exists
     * or not and will create an entry if the player is
     * online but does not exist in the money.yml file.
     *
     * @var $player
     * @return boolean
     */
    public function playerExists($player) {
        $player = strtolower($player);
        $exists = false;

        if($this->data->getNested('balance.'.$player) !== null) $exists = true;

        if($exists === false AND $this->plugin->getServer()->getPlayer($player) !== null) {
            $exists = true;
            $this->createPlayer($player, $this->startBalance);
        }

        return $exists;
    }

    /**
     * Returns an array with the top X
     * richest players.
     *
     * @param int $limit
     * @return array
     */
    public function getTop($limit = 10) {

        $players = $this->data->get('balance');
        if($players === false) return [];
        # Sort by highest value.
        arsort($players);

        return array_splice($players, 0, $limit);

    }

    /**
     * Returns the rank of the specified
     * player or null if it does not exist.
     *
     * @param $player
     * @return int|null
     */
    public function getRank($player) {

        $player = strtolower($player);
        $players = $this->data->get('balance');

        if(!isset($players[$player])) return null;
        # Sort by highest value.
        arsort($players);

        $rank = 0;

        foreach($players as $name => $balance) {
            $rank++;
            if($name === $player) break;
        }

        return $rank;

    }

    /**
     * Saves the data to disk.
     */
    public function save() {
        $this->data->save();
    }

    /**
     * Returns the start balance when a
     * new account is created.
     *
     * @return float
     */
    public function getStartBalance() {
        return $this->startBalance;
    }

    public function getBalanceAll() {
        return $this->data->get('balance');
    }

}