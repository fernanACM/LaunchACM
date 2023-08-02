<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM
 
namespace fernanACM\LaunchACM;

use pocketmine\player\Player;

use pocketmine\event\Listener;

use pocketmine\block\BlockTypeIds;

use pocketmine\event\entity\EntityDamageEvent;

use pocketmine\event\player\PlayerMoveEvent;

use fernanACM\LaunchACM\manager\LaunchManager;
use fernanACM\LaunchACM\utils\PluginUtils;

class Event implements Listener{

    /**
     * @param PlayerMoveEvent $event
     * @return void
     */
    public function onMove(PlayerMoveEvent $event): void {
        $player = $event->getPlayer();
        $block = $player->getWorld()->getBlock($player->getPosition());
        $config = LP::getInstance()->config;
    
        if(LaunchManager::getInstance()->getWorldsEnabled($player)){
            if($block->getTypeId() === BlockTypeIds::STONE_PRESSURE_PLATE){
                if($config->getNested("LaunchPad.LaunchPads.stone_pressure_plate")){
                    if($this->getLaunchPadId($player, 0))return;
                }
            }
            if($block->getTypeId() === BlockTypeIds::ACACIA_PRESSURE_PLATE){
                if($config->getNested("LaunchPad.LaunchPads.acacia_pressure_plate")){
                    if($this->getLaunchPadId($player, 1))return;
                }
            }
            if($block->getTypeId() === BlockTypeIds::BIRCH_PRESSURE_PLATE){
                if($config->getNested("LaunchPad.LaunchPads.birch_pressure_plate")){
                    if($this->getLaunchPadId($player, 2))return;
                }
            }
            if($block->getTypeId() === BlockTypeIds::DARK_OAK_PRESSURE_PLATE){
                if($config->getNested("LaunchPad.LaunchPads.dark_oak_pressure_plate")){
                    if($this->getLaunchPadId($player, 3))return;
                }
            }
            if($block->getTypeId() === BlockTypeIds::JUNGLE_PRESSURE_PLATE){
                if($config->getNested("LaunchPad.LaunchPads.jungle_pressure_plate")){
                    if($this->getLaunchPadId($player, 4))return;
                }
            }
            if($block->getTypeId() === BlockTypeIds::OAK_PRESSURE_PLATE){
                if($config->getNested("LaunchPad.LaunchPads.oak_pressure_plate")){
                    if($this->getLaunchPadId($player, 5))return;
                }
            }
            if($block->getTypeId() === BlockTypeIds::SPRUCE_PRESSURE_PLATE){
                if($config->getNested("LaunchPad.LaunchPads.spruce_pressure_plate")){
                    if($this->getLaunchPadId($player, 6))return;
                }
            }
            if($block->getTypeId() === BlockTypeIds::WEIGHTED_PRESSURE_PLATE_HEAVY){
                if($config->getNested("LaunchPad.LaunchPads.weighted_pressure_plate_heavy")){
                    if($this->getLaunchPadId($player, 7))return;
                }
            }
            if($block->getTypeId() === BlockTypeIds::WEIGHTED_PRESSURE_PLATE_LIGHT){
                if($config->getNested("LaunchPad.LaunchPads.weighted_pressure_plate_light")){
                    if($this->getLaunchPadId($player, 8))return;
                }
            }
            if($block->getTypeId() === BlockTypeIds::POLISHED_BLACKSTONE_PRESSURE_PLATE){
                if($config->getNested("LaunchPad.LaunchPads.polished_blackstone_pressure_plate")){
                    if($this->getLaunchPadId($player, 9))return;
                }
            }
            if($block->getTypeId() === BlockTypeIds::MANGROVE_PRESSURE_PLATE){
                if($config->getNested("LaunchPad.LaunchPads.mangrove_pressure_plate")){
                    if($this->getLaunchPadId($player, 10))return;
                }
            }
            if($block->getTypeId() === BlockTypeIds::CRIMSON_PRESSURE_PLATE){
                if($config->getNested("LaunchPad.LaunchPads.crimson_pressure_plate")){
                    if($this->getLaunchPadId($player, 11))return;
                }
            }
            if($block->getTypeId() === BlockTypeIds::WARPED_PRESSURE_PLATE){
                if($config->getNested("LaunchPad.LaunchPads.warped_pressure_plate")){
                    if($this->getLaunchPadId($player, 12))return;
                }
            }
            if($block->getTypeId() === BlockTypeIds::CHERRY_PRESSURE_PLATE){
                if($config->getNested("LaunchPad.LaunchPads.cherry_pressure_plate")){
                    if($this->getLaunchPadId($player, 13))return;
                }
            }
            $block = $player->getWorld()->getBlock($player->getPosition()->getSide(0));
            // TRAMPOLINE
            if($block->getTypeId() === BlockTypeIds::SLIME){
                if($config->getNested("Trampoline.trampoline-use")){
                    if($this->getTrampoline($player, 0))return;
                }
            }
        }
    }
    
    /**
     * @param EntityDamageEvent $event
     * @return void
     */
    public function onPlayerDamage(EntityDamageEvent $event): void{
        $entity = $event->getEntity();
        if(!$entity instanceof Player)return;
        if($event->getCause() !== EntityDamageEvent::CAUSE_FALL)return;
        if(!isset(LaunchManager::getInstance()->cancel_fall_damage[$entity->getName()]))return;
        unset(LaunchManager::getInstance()->cancel_fall_damage[$entity->getName()]);
        $event->cancel();
    }

    /**
     * @param Player $player
     * @param integer $typeId
     * @return boolean
     */
    private function getLaunchPadId(Player $player, int $typeId): bool{
        foreach(LaunchManager::LAUNCH_PAD_LIST as $type => $id){
            if($typeId === $id){
                $launchType = LaunchManager::getInstance()->launchpadPerWorlds($id, $type, $player->getWorld()->getFolderName());
                LaunchManager::getInstance()->addVelocityToEntity($player, $launchType["knockback"], $launchType["height"]);
                LaunchManager::getInstance()->addLaunchpadEffects($player);
                if(LP::getInstance()->config->getNested("Settings.launchpad-no-sound")){
                    PluginUtils::BroadSound($player, $launchType["soundName"], 500, $launchType["soundPitch"]);
                }
                return true;
            }
        }
        return false;
    }

    /**
     * @param Player $player
     * @param integer $typeId
     * @return boolean
     */
    private function getTrampoline(Player $player, int $typeId): bool{
        foreach(LaunchManager::TRAMPOLINE_LIST as $type => $id){
            if($typeId === $id){
                $trampolineType = LaunchManager::getInstance()->trampolinePerWorlds($player->getWorld()->getFolderName());
                LaunchManager::getInstance()->addReboundTrampoline($player, $trampolineType["height"]);
                LaunchManager::getInstance()->addLaunchpadEffects($player);
                if(LP::getInstance()->config->getNested("Settings.trampoline-no-sound")){
                    PluginUtils::BroadSound($player, $trampolineType["soundName"], 500, $trampolineType["soundPitch"]);
                }
                return true;
            }
        }
        return false;
    }
}