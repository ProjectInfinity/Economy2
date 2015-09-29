<?php

namespace Leet\Economy2\command;

use Leet\Economy2\Economy2;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;

class TopMoneyCommand implements CommandExecutor {

    private $plugin, $money;

    public function __construct(Economy2 $plugin) {
        $this->plugin = $plugin;
        $this->money = $plugin->getMoneyHandler();
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args) {

        if(!$sender->hasPermission('economy2.command.topmoney')) {
            $sender->sendMessage($this->plugin->getMessageHandler()->no_permission);
            return true;
        }

        $top = $this->money->getTop();
        $rank = $this->money->getRank($sender->getName());

        if($rank !== null) $sender->sendMessage(sprintf($this->plugin->getMessageHandler()->balance_rank, $rank));

        $i = 1;
        foreach($top as $player => $balance) {
            $sender->sendMessage(sprintf($this->plugin->getMessageHandler()->balance_top, $i, $player, $balance,
                ($balance > 1) ? $this->money->getPluralName() : $this->money->getSingularName()));
            $i++;
        }

        return true;

    }
}