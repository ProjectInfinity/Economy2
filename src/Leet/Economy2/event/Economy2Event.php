<?php

namespace Leet\Economy2\event;

use Leet\Economy2\Economy2;
use pocketmine\event\Cancellable;
use pocketmine\event\plugin\PluginEvent;

class Economy2Event extends PluginEvent implements Cancellable {

    private $issuer;

    public function __construct(Economy2 $plugin, $issuer) {
        parent::__construct($plugin);
        $this->issuer = $issuer;
    }

    /**
     * Returns the issuer of the command.
     */
    public function getIssuer() {
        return $this->issuer;
    }

}