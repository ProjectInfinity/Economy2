<?php

namespace Leet\Economy2\command;

use Leet\Economy2\Economy2;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class BalanceCommand implements CommandExecutor {

    private $plugin;
    private $money;
    private $messages;

    public function __construct(Economy2 $plugin) {
        $this->plugin = $plugin;
        $this->money = $plugin->getMoneyHandler();
        $this->messages = $plugin->getMessageHandler();
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args) {

        if(!$sender->hasPermission('economy2.command.balance') or !($sender instanceof Player)) {
            $sender->sendMessage($this->plugin->getMessageHandler()->no_permission);
            return true;
        }

        # Check if the player is attempting to view another player's balance.
        $own = (count($args) > 0) ? false : true;
        
        $target = '';
        
        if(!$own) $target = strtolower(implode(' ', array_slice($args, 0, count($args), true)));

        # Check if specified user is sender. If so $own should be true.
        if(!$own and $target === strtolower($sender->getName())) $own = true;

        $balance = $this->money->getBalance($own ? $sender->getName() : $target, $own ? true : $this->plugin->getServer()->getPlayer($target) !== null);

        # Player does not exist.
        if($balance === null) {
            $sender->sendMessage($this->plugin->getMessageHandler()->player_not_exists);
            return true;
        }

        $plural = true;

        if($balance == 0) $plural = false;

        if($own) {
            $sender->sendMessage(sprintf($this->messages->balance_own, number_format($balance, 2), ($plural) ? $this->money->getPluralName() : $this->money->getSingularName()));
        } else {
            $sender->sendMessage(sprintf($this->messages->balance_other, $target, number_format($balance, 2), ($plural) ? $this->money->getPluralName() : $this->money->getSingularName()));
        }

        return true;

    }
}