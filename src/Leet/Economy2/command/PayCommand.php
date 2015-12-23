<?php

namespace Leet\Economy2\command;

use Leet\Economy2\Economy2;
use Leet\Economy2\event\money\AlterMoneyEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class PayCommand implements CommandExecutor {

    private $plugin, $money;

    public function __construct(Economy2 $plugin) {
        $this->plugin = $plugin;
        $this->money = $plugin->getMoneyHandler();
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args) {

        if(!$sender->hasPermission('economy2.command.pay') or !($sender instanceof Player)) {
            $sender->sendMessage($this->plugin->getMessageHandler()->no_permission);
            return true;
        }

        if(count($args) < 2) {
            if(count($args) < 1) $sender->sendMessage($this->plugin->getMessageHandler()->amount_missing);
            if(count($args) > 0) $sender->sendMessage($this->plugin->getMessageHandler()->player_missing);
            return true;
        }

        $target = $args[0];
        $amount = $args[1];

        # Stop processing if the player does not exist.
        if(!$this->money->playerExists($target)) {
            $sender->sendMessage($this->plugin->getMessageHandler()->player_not_exists);
            return true;
        }

        # Stop processing if the specified amount is not numeric.
        if(!is_numeric($amount)) {
            $sender->sendMessage($this->plugin->getMessageHandler()->amount_invalid);
            return true;
        }

        $amount = (float) $amount;

        # Stop pointless transactions or attempted exploitation.
        if($amount <= 0) {
            $sender->sendMessage($this->plugin->getMessageHandler()->amount_invalid);
            return true;
        }

        $balance = $this->money->getBalance($sender->getName(), true);

        # Ensure that the sender has enough money.
        if($balance < $amount) {
            $sender->sendMessage($this->plugin->getMessageHandler()->balance_too_low);
            return true;
        }

        $this->money->alterBalance($sender->getName(), -$amount);
        $this->money->alterBalance($target, $amount);

        $sender->sendMessage(sprintf($this->plugin->getMessageHandler()->balance_sent, $amount,
            ($amount > 1) ? $this->money->getPluralName() : $this->money->getSingularName(), $target));

        $target = $this->plugin->getServer()->getPlayer($target);

        # Message the target player if he/she is online.
        if($this->plugin->getServer()->getPlayer($target) !== null) {
            $target->sendMessage(sprintf($this->plugin->getMessageHandler()->balance_received, $sender->getName(),
                $amount, ($amount > 1) ? $this->money->getPluralName() : $this->money->getSingularName()));
        }

        $this->plugin->getServer()->getPluginManager()->callEvent(new AlterMoneyEvent($this->plugin, $sender->getName(), $target, $amount, true));

        return true;

    }
}