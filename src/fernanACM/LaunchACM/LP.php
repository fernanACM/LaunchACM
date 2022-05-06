<?php
    
namespace fernanACM\LaunchACM;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\utils\Config;

use pocketmine\plugin\PluginBase;

use pocketmine\item\ItemIds;

use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockLegacyIds;

use pocketmine\block\StonePressurePlate;
use pocketmine\block\WoodenPressurePlate;

use pocketmine\entity\Entity;
use pocketmine\entity\Living;

use pocketmine\math\Vector3;

use fernanACM\LaunchACM\utils\PluginUtils;

class LP extends PluginBase{
    
    public Config $config;
    
    public static $instance;
    
    public function onEnable(): void{
        self::$instance = $this;
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml");
        $this->saveDefaultConfig();
        $this->loadEvents();
    }
    
    public function loadEvents(){
        $blockF = BlockFactory::getInstance();
        # LaunchPad - StonePressurePlate
        if (LP::getInstance()->config->get("LaunchPad")["StonePressurePlate"]) {
            $blockF->register(new class(new BlockIdentifier(BlockLegacyIds::STONE_PRESSURE_PLATE,0),"Stone_Pressure_Plate",new BlockBreakInfo(0)) extends StonePressurePlate{
                public function hasEntityCollision(): bool{
                   return true;
                }
                public function addVelocityToEntity(Entity $entity): ?Vector3{
                    if($entity instanceof Living){
                        if(!in_array($entity->getWorld()->getFolderName(), LP::getInstance()->config->get("Settings")["disabled-worlds"])){
                            $entity->knockBack( $entity->getDirectionVector()->getX(), $entity->getDirectionVector()->getZ(), LP::getInstance()->config->get("Settings")["knockback-amount"]);
                            if (LP::getInstance()->config->get("Settings")["launchpad-no-sound"]) {
                                PluginUtils::PlaySound($entity, LP::getInstance()->config->get("Settings")["launchpad-sound"], 5, 8);
                            }
                        }
                    }
                    parent::addVelocityToEntity($entity);
            	    return null;
                }
            }, true);
        }
        
        # LaunchPad - WoodenPressurePlate
        if (LP::getInstance()->config->get("LaunchPad")["OakPressurePlate"]) {
            $blockF->register(new class(new BlockIdentifier(BlockLegacyIds::WOODEN_PRESSURE_PLATE,0),"Wooden_Pressure_Plate",new BlockBreakInfo(0)) extends WoodenPressurePlate{
                public function hasEntityCollision(): bool{
                   return true;
                }
                public function addVelocityToEntity(Entity $entity): ?Vector3{
                    if($entity instanceof Living) {
                        if (!in_array($entity->getWorld()->getFolderName(), LP::getInstance()->config->get("Settings")["disabled-worlds"])) {
                            $entity->knockBack($entity->getDirectionVector()->getX(), $entity->getDirectionVector()->getZ(), LP::getInstance()->config->get("Settings")["knockback-amount"]);
                            if (LP::getInstance()->config->get("Settings")["launchpad-no-sound"]) {
                                PluginUtils::PlaySound($entity, LP::getInstance()->config->get("Settings")["launchpad-sound"], 5, 8);
                            }
                        }
                    }
                    parent::addVelocityToEntity($entity);
                    return null;
                }
            }, true);         
        }
        
        # LaunchPad - ACACIA_PRESSURE_PLATE
        if (LP::getInstance()->config->get("LaunchPad")["AcaciaPressurePlate"]) {
            $blockF->register(new class(new BlockIdentifier(BlockLegacyIds::ACACIA_PRESSURE_PLATE,0),"Acacia_Pressure_Plate",new BlockBreakInfo(0)) extends WoodenPressurePlate{
                public function hasEntityCollision(): bool{
                   return true;
                }
                public function addVelocityToEntity(Entity $entity): ?Vector3{
                    if($entity instanceof Living) {
                        if (!in_array($entity->getWorld()->getFolderName(), LP::getInstance()->config->get("Settings")["disabled-worlds"])) {
                            $entity->knockBack($entity->getDirectionVector()->getX(), $entity->getDirectionVector()->getZ(), LP::getInstance()->config->get("Settings")["knockback-amount"]);
                            if (LP::getInstance()->config->get("Settings")["launchpad-no-sound"]) {
                                PluginUtils::PlaySound($entity, LP::getInstance()->config->get("Settings")["launchpad-sound"], 5, 8);
                            }
                        }
                    }
                    parent::addVelocityToEntity($entity);
                    return null;
                }
            }, true);
        }
        
        # LaunchPad - BIRCH_PRESSURE_PLATE
        if (LP::getInstance()->config->get("LaunchPad")["BirchPressurePlate"]) {
            $blockF->register(new class(new BlockIdentifier(BlockLegacyIds::BIRCH_PRESSURE_PLATE,0),"Birch_Pressure_Plate",new BlockBreakInfo(0)) extends WoodenPressurePlate{
               public function hasEntityCollision(): bool{
                   return true;
                }
                public function addVelocityToEntity(Entity $entity): ?Vector3{
                    if($entity instanceof Living) {
                        if (!in_array($entity->getWorld()->getFolderName(), LP::getInstance()->config->get("Settings")["disabled-worlds"])) {
                            $entity->knockBack($entity->getDirectionVector()->getX(), $entity->getDirectionVector()->getZ(), LP::getInstance()->config->get("Settings")["knockback-amount"]);
                            if (LP::getInstance()->config->get("Settings")["launchpad-no-sound"]) {
                                PluginUtils::PlaySound($entity, LP::getInstance()->config->get("Settings")["launchpad-sound"], 5, 8);
                            }
                        }
                    }
                    parent::addVelocityToEntity($entity);
                    return null;
                }
            }, true);
        }
        
        # LaunchPad - DARK_OAK_PRESSURE_PLATE
        if (LP::getInstance()->config->get("LaunchPad")["DarkOakPressurePlate"]) {
            $blockF->register(new class(new BlockIdentifier(BlockLegacyIds::DARK_OAK_PRESSURE_PLATE,0),"Dark_Oak_Pressure_Plate",new BlockBreakInfo(0)) extends WoodenPressurePlate{
                public function hasEntityCollision(): bool{
                   return true;
                }
                public function addVelocityToEntity(Entity $entity): ?Vector3{
                    if($entity instanceof Living) {
                        if (!in_array($entity->getWorld()->getFolderName(), LP::getInstance()->config->get("Settings")["disabled-worlds"])) {
                            $entity->knockBack($entity->getDirectionVector()->getX(), $entity->getDirectionVector()->getZ(), LP::getInstance()->config->get("Settings")["knockback-amount"]);
                            if (LP::getInstance()->config->get("Settings")["launchpad-no-sound"]) {
                                PluginUtils::PlaySound($entity, LP::getInstance()->config->get("Settings")["launchpad-sound"], 5, 8);
                            }
                        }
                    }
                    parent::addVelocityToEntity($entity);
                    return null;
                }
            }, true);
        }
        
        # LaunchPad - JUNGLE_PRESSURE_PLATE
        if (LP::getInstance()->config->get("LaunchPad")["JunglePressurePlate"]) {
            $blockF->register(new class(new BlockIdentifier(BlockLegacyIds::JUNGLE_PRESSURE_PLATE,0),"Jungle_Pressure_Plate",new BlockBreakInfo(0)) extends WoodenPressurePlate{
                public function hasEntityCollision(): bool{
                   return true;
                }
                public function addVelocityToEntity(Entity $entity): ?Vector3{
                    if($entity instanceof Living) {
                        if (!in_array($entity->getWorld()->getFolderName(), LP::getInstance()->config->get("Settings")["disabled-worlds"])) {
                            $entity->knockBack($entity->getDirectionVector()->getX(), $entity->getDirectionVector()->getZ(), LP::getInstance()->config->get("Settings")["knockback-amount"]);
                            if (LP::getInstance()->config->get("Settings")["launchpad-no-sound"]) {
                                PluginUtils::PlaySound($entity, LP::getInstance()->config->get("Settings")["launchpad-sound"], 5, 8);
                            }
                        }
                    }
                    parent::addVelocityToEntity($entity);
                    return null;
                }
            }, true);
        }
        
        # LaunchPad - SPRUCE_PRESSURE_PLATE
        if (LP::getInstance()->config->get("LaunchPad")["SprucePressurePlate"]) {
            $blockF->register(new class(new BlockIdentifier(BlockLegacyIds::SPRUCE_PRESSURE_PLATE,0),"Spruce_Pressure_Plate",new BlockBreakInfo(0)) extends WoodenPressurePlate{
                public function hasEntityCollision(): bool{
                   return true;
                }
                public function addVelocityToEntity(Entity $entity): ?Vector3{
                    if($entity instanceof Living) {
                        if (!in_array($entity->getWorld()->getFolderName(), LP::getInstance()->config->get("Settings")["disabled-worlds"])) {
                            $entity->knockBack($entity->getDirectionVector()->getX(), $entity->getDirectionVector()->getZ(), LP::getInstance()->config->get("Settings")["knockback-amount"]);
                            if (LP::getInstance()->config->get("Settings")["launchpad-no-sound"]) {
                                PluginUtils::PlaySound($entity, LP::getInstance()->config->get("Settings")["launchpad-sound"], 5, 8);
                            }
                        }
                    }
                    parent::addVelocityToEntity($entity);
                    return null;
                }
            }, true);
        }
        
        # LaunchPad - LIGHT_WEIGHTED_PRESSURE_PLATE
        if (LP::getInstance()->config->get("LaunchPad")["LightWeightedPressurePlate"]) {
            $blockF->register(new class(new BlockIdentifier(BlockLegacyIds::LIGHT_WEIGHTED_PRESSURE_PLATE,0),"Light_Weighted_Pressure_Plate",new BlockBreakInfo(0)) extends StonePressurePlate{
                public function hasEntityCollision(): bool{
                   return true;
                }
                public function addVelocityToEntity(Entity $entity): ?Vector3{
                    if($entity instanceof Living){
                        if(!in_array($entity->getWorld()->getFolderName(), LP::getInstance()->config->get("Settings")["disabled-worlds"])){
                            $entity->knockBack( $entity->getDirectionVector()->getX(), $entity->getDirectionVector()->getZ(), LP::getInstance()->config->get("Settings")["knockback-amount"]);
                            if (LP::getInstance()->config->get("Settings")["launchpad-no-sound"]) {
                                PluginUtils::PlaySound($entity, LP::getInstance()->config->get("Settings")["launchpad-sound"], 5, 8);
                            }
                        }
                    }
                    parent::addVelocityToEntity($entity);
            	    return null;
                }
            }, true);
        }
        
        # LaunchPad - HEAVY_WEIGHTED_PRESSURE_PLATE
        if (LP::getInstance()->config->get("LaunchPad")["HeavyWeightedPressurePlate"]) {
            $blockF->register(new class(new BlockIdentifier(BlockLegacyIds::HEAVY_WEIGHTED_PRESSURE_PLATE,0),"Heavy_Weighted_Pressure_Plate",new BlockBreakInfo(0)) extends StonePressurePlate{
                public function hasEntityCollision(): bool{
                   return true;
                }
                public function addVelocityToEntity(Entity $entity): ?Vector3{
                    if($entity instanceof Living){
                        if(!in_array($entity->getWorld()->getFolderName(), LP::getInstance()->config->get("Settings")["disabled-worlds"])){
                            $entity->knockBack( $entity->getDirectionVector()->getX(), $entity->getDirectionVector()->getZ(), LP::getInstance()->config->get("Settings")["knockback-amount"]);
                            if (LP::getInstance()->config->get("Settings")["launchpad-no-sound"]) {
                                PluginUtils::PlaySound($entity, LP::getInstance()->config->get("Settings")["launchpad-sound"], 5, 8);
                            }
                        }
                    }
                    parent::addVelocityToEntity($entity);
            	    return null;
                }
            }, true);
        } 
    }
    
    public static function getInstance(): LP{
        return self::$instance;
    }
}
