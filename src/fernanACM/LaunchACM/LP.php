<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM
    
namespace fernanACM\LaunchACM;

use pocketmine\Server;

use pocketmine\utils\Config;

use pocketmine\plugin\PluginBase;

use DaPigGuy\libPiggyUpdateChecker\libPiggyUpdateChecker;

use fernanACM\LaunchACM\Event;
use fernanACM\LaunchACM\manager\LaunchManager;

class LP extends PluginBase{
    
    /** @var Config $config */
    public Config $config;
    
    /** @var LP $instance */
    private static LP $instance;

    # CheckConfig
    private const CONFIG_VERSION = "1.0.0";

    /**
     * @return void
     */
    public function onLoad(): void{
        self::$instance = $this;
        $this->loadFiles();
    }
    
    /**
     * @return void
     */
    public function onEnable(): void{
        $this->loadCheck();
        $this->loadVirions();
        $this->loadEvents();
    }

    /**
     * @return void
     */
    private function loadFiles(): void{
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml");
    }

    /**
     * @return void
     */
    private function loadCheck(): void{
         # CONFIG
         if((!$this->config->exists("config-version")) || ($this->config->get("config-version") != self::CONFIG_VERSION)){
            rename($this->getDataFolder() . "config.yml", $this->getDataFolder() . "config_old.yml");
            $this->saveResource("config.yml");
            $this->getLogger()->critical("Your configuration file is outdated.");
            $this->getLogger()->notice("Your old configuration has been saved as config_old.yml and a new configuration file has been generated. Please update accordingly.");
        }
    }

    /**
     * @return void
     */
    private function loadVirions(): void{
        foreach([
            "libPiggyUpdateChecker" => libPiggyUpdateChecker::class
            ] as $virion => $class
        ){
            if(!class_exists($class)){
                $this->getLogger()->error($virion . " virion not found. Please download LaunchACM from Poggit-CI or use DEVirion (not recommended).");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            }
        }
        # Update
        libPiggyUpdateChecker::init($this);
    }

    /**
     * @return void
     */
    private function loadEvents(): void{
        Server::getInstance()->getPluginManager()->registerEvents(new Event, $this);
    }

    /**
     * @return LaunchManager
     */
    public static function getLaunchManager(): LaunchManager{
        return LaunchManager::getInstance();
    }

    /**
     * @return LP
     */
    public static function getInstance(): LP{
        return self::$instance;
    }
}
