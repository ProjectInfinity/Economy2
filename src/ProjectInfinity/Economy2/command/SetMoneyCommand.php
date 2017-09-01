<?php

namespace ProjectInfinity\Economy2\command;

use ProjectInfinity\Economy2\Economy2;
use ProjectInfinity\Economy2\event\money\SetMoneyEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;

class SetMoneyCommand implements CommandExecutor {

    private $plugin, $money;

    public function __construct(Economy2 $plugin) {
        $this->plugin = $plugin;
        $this->money = $plugin->getMoneyHandler();
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {

        if(!$sender->hasPermission('economy2.command.setmoney')) {
            $sender->sendMessage($this->plugin->getMessageHandler()->no_permission);
            return true;
        }

        if(count($args) < 2) {
            if(count($args) < 1) $sender->sendMessage($this->plugin->getMessageHandler()->amount_missing);
            if(count($args) > 0) $sender->sendMessage($this->plugin->getMessageHandler()->player_missing);
            return true;
        }

        $target = implode(' ', array_slice($args, 0, count($args) - 1, true));
        $balance = $args[count($args) - 1];

        # Stop processing if the player does not exist.
        if(!$this->money->playerExists($target)) {
            $sender->sendMessage($this->plugin->getMessageHandler()->player_not_exists);
            return true;
        }

        # Stop processing if the specified amount is not numeric.
        if(!is_numeric($balance)) {
            $sender->sendMessage($this->plugin->getMessageHandler()->amount_invalid);
            return true;
        }

        $balance = (float) $balance;

        $this->money->setBalance($target, $balance);

        $sender->sendMessage(sprintf($this->plugin->getMessageHandler()->balance_set, $target,
            number_format($balance, 2), ($balance > 1) ? $this->money->getPluralName() : $this->money->getSingularName(), $target));

        $targetPlayer = $this->plugin->getServer()->getPlayer($target);

        # Message the target player if he/she is online.
        if($targetPlayer !== null) {
            $targetPlayer->sendMessage(sprintf($this->plugin->getMessageHandler()->balance_changed, number_format($balance, 2),
                ($balance > 1) ? $this->money->getPluralName() : $this->money->getSingularName(), $sender->getName()));
        }

        $this->plugin->getServer()->getPluginManager()->callEvent(new SetMoneyEvent($this->plugin, $sender->getName(), $target, $balance));

        return true;

    }
}