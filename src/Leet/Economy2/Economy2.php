<?php

namespace Leet\Economy2;

use Leet\Economy2\command\BalanceCommand;
use Leet\Economy2\command\GiveMoneyCommand;
use Leet\Economy2\command\SetMoneyCommand;
use Leet\Economy2\command\TakeMoneyCommand;
use Leet\Economy2\command\TopMoneyCommand;
use Leet\Economy2\command\PayCommand;
use Leet\Economy2\util\MessageHandler;
use Leet\Economy2\util\MoneyHandler;

use onebone\economyapi\EconomyAPI;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Economy2 extends PluginBase {

    # Declare the API version so that other plugins may be notified.
    const API_VERSION = 1;

    private static $plugin;

    # Config version.
    private $version;

    /** @var MoneyHandler */
    private $moneyHandler;

    /** @var MessageHandler */
    private $messageHandler;

    /** @var EconomyAPI */
    private $economyDummy;

    public function onEnable() {

        self::$plugin = $this;

        $this->saveDefaultConfig();
        $this->reloadConfig();

        $this->version = $this->getConfig()->get('version', 999);
        $this->messageHandler = new MessageHandler($this, $this->version);

        if(!is_file($this->getDataFolder().'money.yml')) {
            $money = new Config($this->getDataFolder().'money.yml', Config::YAML);
            $money->save();
        }

        $this->moneyHandler = new MoneyHandler($this);

        # Attempt to register the fake EconomyAPI plugin.
        if(!file_exists($this->getDataFolder().'/EconomyAPI.phar')) {
            $this->saveResource('EconomyAPI.phar');
        }
        $this->economyDummy = $this->getServer()->getPluginManager()->loadPlugin($this->getDataFolder().'/EconomyAPI.phar');
        $this->getServer()->enablePlugin($this->economyDummy);

        # Check for old economy plugins that need "reviving".
        foreach (glob($this->getServer()->getPluginPath().'Economy*.phar') as $filename) {
            if($filename === 'Economy2' or $filename === 'Economy2Contracts' or $filename === 'Economy2Shop') continue;

            foreach($this->getServer()->getPluginManager()->getPlugins() as $plugin) {
                if($plugin->getName() === substr($filename, 0, strlen($filename) - 5)) {
                    $this->getServer()->getPluginManager()->enablePlugin($plugin);
                }
            }
            $this->getServer()->getPluginManager()->loadPlugin($filename);
        }
        # Enable the revived plugins.
        foreach($this->getServer()->getPluginManager()->getPlugins() as $plugin) {
            if($plugin->getName() === 'EconomyAirport')
                $this->getServer()->getPluginManager()->enablePlugin($this->getServer()->getPluginManager()->getPlugin('EconomyAirport'));
            if($plugin->getName() === 'EconomyAuction')
                $this->getServer()->getPluginManager()->enablePlugin($this->getServer()->getPluginManager()->getPlugin('EconomyAuction'));
            if($plugin->getName() === 'EconomyCasino')
                $this->getServer()->getPluginManager()->enablePlugin($this->getServer()->getPluginManager()->getPlugin('EconomyCasino'));
            if($plugin->getName() === 'EconomyLand')
                $this->getServer()->getPluginManager()->enablePlugin($this->getServer()->getPluginManager()->getPlugin('EconomyLand'));
            if($plugin->getName() === 'EconomyProperty')
                $this->getServer()->getPluginManager()->enablePlugin($this->getServer()->getPluginManager()->getPlugin('EconomyProperty'));
            if($plugin->getName() === 'EconomyPShop')
                $this->getServer()->getPluginManager()->enablePlugin($this->getServer()->getPluginManager()->getPlugin('EconomyPShop'));
            if($plugin->getName() === 'EconomySell')
                $this->getServer()->getPluginManager()->enablePlugin($this->getServer()->getPluginManager()->getPlugin('EconomySell'));
            if($plugin->getName() === 'EconomyShop')
                $this->getServer()->getPluginManager()->enablePlugin($this->getServer()->getPluginManager()->getPlugin('EconomyShop'));
            if($plugin->getName() === 'EconomyTax')
                $this->getServer()->getPluginManager()->enablePlugin($this->getServer()->getPluginManager()->getPlugin('EconomyTax'));
            if($plugin->getName() === 'EconomyUsury')
                $this->getServer()->getPluginManager()->enablePlugin($this->getServer()->getPluginManager()->getPlugin('EconomyUsury'));
            if($plugin->getName() === 'EconomyJob')
                $this->getServer()->getPluginManager()->enablePlugin($this->getServer()->getPluginManager()->getPlugin('EconomyJob'));
        }

        # Register all commands.
        $this->getCommand('balance')->setExecutor(new BalanceCommand($this));
        $this->getCommand('givemoney')->setExecutor(new GiveMoneyCommand($this));
        $this->getCommand('pay')->setExecutor(new PayCommand($this));
        $this->getCommand('setmoney')->setExecutor(new SetMoneyCommand($this));
        $this->getCommand('takemoney')->setExecutor(new TakeMoneyCommand($this));
        $this->getCommand('topmoney')->setExecutor(new TopMoneyCommand($this));

    }

    public function onDisable() {

        # Save data to disk.
        $this->moneyHandler->save();

        # Cleanup in case of a reload.
        unset($this->moneyHandler);
        unset($this->version);
        unset($this->economyDummy);

        self::$plugin = null;

    }

    /** @return Economy2 */
    public static function getPlugin() {
        return self::$plugin;
    }

    public function getMoneyHandler() {
        return $this->moneyHandler;
    }

    public function getMessageHandler() {
        return $this->messageHandler;
    }

}