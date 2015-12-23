<?php

namespace Leet\Economy2\util;

use Leet\Economy2\Economy2;
use pocketmine\utils\TextFormat;

class MessageHandler {

    private $plugin;
    private $version;
    private static $colors;

    public $no_permission;

    public $balance_own;
    public $balance_other;
    public $balance_too_low;
    public $balance_sent;
    public $balance_received;
    public $balance_reduced;
    public $balance_given;
    public $balance_set;
    public $balance_changed;
    public $balance_took;
    public $balance_rank;
    public $balance_top;

    public $amount_missing;
    public $amount_invalid;
    public $amount_too_high;

    public $player_missing;
    public $player_not_exists;

    public function __construct(Economy2 $plugin, $version) {

        self::$colors = (new \ReflectionClass(TextFormat::class))->getConstants();
        $this->plugin = $plugin;
        $this->version = $version;

        $this->no_permission = $this->parseColors($plugin->getConfig()->getNested('messages.no-permission', '%red%You don\'t have permission to do that.'));

        $this->balance_own = $this->parseColors($plugin->getConfig()->getNested('messages.balance.own', '%yellow%Your balance is %green%%s %yellow%%s'));
        $this->balance_other = $this->parseColors($plugin->getConfig()->getNested('messages.balance.other', '%yellow%%s\'s balance is %green%%s %yellow%%s'));
        $this->balance_too_low = $this->parseColors($plugin->getConfig()->getNested('messages.balance.too-low', '%red%You do not have enough money.'));
        $this->balance_sent = $this->parseColors($plugin->getConfig()->getNested('messages.balance.sent', '%yellow%You sent %green%%s %yellow%%s to %green%%s'));
        $this->balance_received = $this->parseColors($plugin->getConfig()->getNested('messages.balance.received', '%green%%s %yellow%sent you %green%%s %yellow%%s'));
        $this->balance_reduced = $this->parseColors($plugin->getConfig()->getNested('messages.balance.reduced', '%yellow%%s took %green%%s %yellow%%s from you'));
        $this->balance_given = $this->parseColors($plugin->getConfig()->getNested('messages.balance.given', '%green%%s %yellow%%s was given to %green%%s'));
        $this->balance_set = $this->parseColors($plugin->getConfig()->getNested('messages.balance.set', '%green%%s%yellow%\'s balance has been set to %green%%s'));
        $this->balance_changed = $this->parseColors($plugin->getConfig()->getNested('messages.balance.changed', '%yellow%Your balance has been set to %green%%s %yellow%%s by %green%%s'));
        $this->balance_took = $this->parseColors($plugin->getConfig()->getNested('messages.balance.took', '%yellow%You took %green%%s %yellow%%s from %green%%s'));
        $this->balance_rank = $this->parseColors($plugin->getConfig()->getNested('messages.balance.rank', '%yellow%Your rank is %green%%u'));
        $this->balance_top = $this->parseColors($plugin->getConfig()->getNested('messages.balance.top', '%yellow%%u. %s - %green%%s %yellow%%s'));

        $this->amount_missing = $this->parseColors($plugin->getConfig()->getNested('messages.amount-missing', '%red%You need to specify an amount.'));
        $this->amount_invalid = $this->parseColors($plugin->getConfig()->getNested('messages.amount-invalid', '%red%The specified amount is invalid!'));
        $this->amount_too_high = $this->parseColors($plugin->getConfig()->getNested('messages.amount-too-high', '%yellow%The amount was higher than the target\'s balance.'));

        $this->player_missing = $this->parseColors($plugin->getConfig()->getNested('messages.player.missing', '%red%You need to specify a player.'));
        $this->player_not_exists = $this->parseColors($plugin->getConfig()->getNested('messages.player.not-exists', '%red%The specified player does not exist.'));

    }

    /**
     * Iterates the color array and replaces the color codes from the provided String.
     * @param $message
     * @return String
     */
    private function parseColors($message) {
        $msg = $message;
        foreach(self::$colors as $color => $value) {
            $key = '%'.strtolower($color).'%';
            if(strpos($msg, $key) !== false) {
                $msg = str_replace($key, $value, $msg);
            }
        }
        return $msg;
    }
}