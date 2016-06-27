<?php

namespace Leet\Economy2\command;

use Leet\Economy2\Economy2;
use Leet\Economy2\event\money\GiveMoneyEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;

class GiveMoneyCommand implements CommandExecutor {

    private $plugin, $money;

    public function __construct(Economy2 $plugin) {
        $this->plugin = $plugin;
        $this->money = $plugin->getMoneyHandler();
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args) {

        if(!$sender->hasPermission('economy2.command.givemoney')) {
            $sender->sendMessage($this->plugin->getMessageHandler()->no_permission);
            return true;
        }

        if(count($args) < 2) {
            if(count($args) < 1) $sender->sendMessage($this->plugin->getMessageHandler()->amount_missing);
            if(count($args) > 0) $sender->sendMessage($this->plugin->getMessageHandler()->player_missing);
            return true;
        }

        $target = implode(' ', array_slice($args, 0, count($args) - 1, true));
        $amount = $args[count($args) - 1];

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

        $this->money->alterBalance($target, $amount);

        $sender->sendMessage(sprintf($this->plugin->getMessageHandler()->balance_given, number_format($amount, 2),
            ($amount > 1) ? $this->money->getPluralName() : $this->money->getSingularName(), $target));

        $targetPlayer = $this->plugin->getServer()->getPlayer($target);

        # Message the target player if he/she is online.
        if($targetPlayer !== null) {
            $targetPlayer->sendMessage(sprintf($this->plugin->getMessageHandler()->balance_received, $target, number_format($amount, 2).
                (($amount > 1) ? $this->money->getPluralName() : $this->money->getSingularName())));
        }

        $this->plugin->getServer()->getPluginManager()->callEvent(new GiveMoneyEvent($this->plugin, $sender->getName(), $target, $amount));

        return true;

    }
}