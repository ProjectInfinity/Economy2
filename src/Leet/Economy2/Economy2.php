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
    # Declare FakeEconomyAPI version so that we know whether to replace the old version or not.
    const BRIDGE_VERSION = 2;

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

        # Check if EconomyAPI exists.
        if(file_exists($this->getServer()->getPluginPath().'EconomyAPI.phar')) {
            unlink($this->getServer()->getPluginPath().'EconomyAPI.phar');
        }

        # Attempt to save the fake EconomyAPI plugin.
        if(!file_exists($this->getServer()->getPluginPath().'FakeEconomyAPI.phar')) {
            $this->saveResource('FakeEconomyAPI.phar');
            rename($this->getDataFolder().'FakeEconomyAPI.phar', $this->getServer()->getPluginPath().'FakeEconomyAPI.phar');
            $this->economyDummy = $this->getServer()->getPluginManager()->loadPlugin($this->getServer()->getPluginPath().'FakeEconomyAPI.phar');
            $this->getServer()->enablePlugin($this->economyDummy);
            $this->getLogger()->warning('FakeEconomyAPI has been created, restart for onebone-economy plugins to work.');
            /** Set bridge version */
            $this->getConfig()->set('bridgeVersion', self::BRIDGE_VERSION);
            $this->saveConfig();
        } else {
            /** Get bridge version */
            if($this->getConfig()->get('bridgeVersion', 0) < self::BRIDGE_VERSION) {
                unlink($this->getServer()->getPluginPath().'FakeEconomyAPI.phar');
                $this->saveResource('FakeEconomyAPI.phar');
                rename($this->getDataFolder().'FakeEconomyAPI.phar', $this->getServer()->getPluginPath().'FakeEconomyAPI.phar');
                $this->economyDummy = $this->getServer()->getPluginManager()->loadPlugin($this->getServer()->getPluginPath().'FakeEconomyAPI.phar');
                $this->getServer()->enablePlugin($this->economyDummy);
                $this->getLogger()->warning('FakeEconomyAPI has been updated, restart for onebone-economy plugins to work.');
                /** Set bridge version */
                $this->getConfig()->set('bridgeVersion', self::BRIDGE_VERSION);
                $this->saveConfig();
            }
            $this->economyDummy = $this->getServer()->getPluginManager()->getPlugin('EconomyAPI');
        }

        # Check if we should migrate EconomyAPI data.
        if(($this->getMoneyHandler()->getBalanceAll() === false or count($this->getMoneyHandler()->getBalanceAll()) === 0)
            and file_exists($this->getServer()->getPluginPath().'EconomyAPI/Money.yml')) {
            $oneboneConfig = new Config($this->getServer()->getPluginPath().'EconomyAPI/Money.yml');
            # Only continue if there are any keys.
            if(count($oneboneConfig->getAll()) !== 0) {

                # Only continue if there are any users.
                if(count($oneboneConfig->get('money')) > 0) {

                    $this->getLogger()->info('Starting import of EconomyAPI data!');
                    $i = 0;
                    # Start importing!
                    foreach($oneboneConfig->get('money') as $player => $balance) {
                        if($balance < 0) continue;
                        $this->moneyHandler->createPlayer($player, $balance, false);
                        $this->getLogger()->info('Imported data for: '.$player.' - '.$balance);
                        $i++;
                    }
                    $this->getMoneyHandler()->save();
                    $this->getLogger()->info('Finished importing. Imported a total of '.count($this->moneyHandler->getBalanceAll()).' players.');

                }

            }
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