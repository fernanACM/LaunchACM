<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM
 
namespace fernanACM\LaunchACM\manager;

use fernanACM\LaunchACM\LP;

use pocketmine\entity\Entity;
use pocketmine\entity\Living;

use pocketmine\math\Vector3;
use pocketmine\player\Player;

use pocketmine\world\particle\AngryVillagerParticle;
use pocketmine\world\particle\FlameParticle;
use pocketmine\world\particle\HappyVillagerParticle;
use pocketmine\world\particle\HeartParticle;

class LaunchManager{

    /** @var LaunchManager|null $instance */
    private static ?LaunchManager $instance = null;

    private const BLACKLIST = "blacklist";
    private const WHITELIST = "whitelist";

    private const PARTICLE_HAPPY = "happy";
    private const PARTICLE_ANGRY = "angry";
    private const PARTICLE_BLAZE = "blaze";
    private const PARTICLE_HEART = "heart";

    public const LAUNCH_PAD_LIST = [
        "stone_pressure_plate" => 0,
        "acacia_pressure_plate" => 1,
        "birch_pressure_plate" => 2,
        "dark_oak_pressure_plate" => 3,
        "jungle_pressure_plate" => 4,
        "oak_pressure_plate" => 5,
        "spruce_pressure_plate" => 6,
        "weighted_pressure_plate_heavy" => 7,
        "weighted_pressure_plate_light" => 8,
        "polished_blackstone_pressure_plate" => 9,
        "mangrove_pressure_plate" => 10,
        "crimson_pressure_plate" => 11,
        "warped_pressure_plate" => 12,
        "cherry_pressure_plate" => 13
    ];
    
    public const TRAMPOLINE_LIST = [
        "slime" => 0
    ];

    /** @var array $cancel_fall_damage */
    public array $cancel_fall_damage = [];

    private function __construct(){
    }

    /**
     * @param Entity $entity
     * @param float $knockback
     * @param float $verticalLimit
     * @return Vector3|null
     */
    public function addVelocityToEntity(Entity $entity, float $knockback, float $verticalLimit): ?Vector3{
        if($entity instanceof Living){
            $entity->knockBack($entity->getDirectionVector()->getX(), $entity->getDirectionVector()->getZ(), $knockback, $verticalLimit);
            $this->cancel_fall_damage[$entity->getName()] = true;
        }
        return null;
    }

    /**
     * @param Entity $entity
     * @return void
     */
    public function addLaunchpadEffects(Entity $entity): void{
        if(!$entity instanceof Living)return;
        $x = $entity->getPosition()->getX();
        $y = $entity->getPosition()->getY();
        $z = $entity->getPosition()->getZ();
        $world = $entity->getWorld()->getBlock($entity->getPosition())->getPosition()->getWorld();
        $particleType = LP::getInstance()->config->getNested("Settings.particle-type");
        if(LP::getInstance()->config->getNested("Settings.particle")){
            switch(strtolower($particleType)){
                case self::PARTICLE_ANGRY:
                    $world->addParticle(new Vector3($x - 0.5, $y, $z), new AngryVillagerParticle($x + 0.5, $y, $z));
                    $world->addParticle(new Vector3($x, $y, $z - 0.5), new AngryVillagerParticle($x, $y, $z + 0.5));
                    $world->addParticle(new Vector3($x + 0.5, $y, $z), new AngryVillagerParticle($x - 0.5, $y, $z));
                    $world->addParticle(new Vector3($x, $y, $z + 0.5), new AngryVillagerParticle($x, $y, $z - 0.5));
                break;

                case self::PARTICLE_HAPPY:
                    $world->addParticle(new Vector3($x - 0.5, $y, $z), new HappyVillagerParticle($x + 0.5, $y, $z));
                    $world->addParticle(new Vector3($x, $y, $z - 0.5), new HappyVillagerParticle($x, $y, $z + 0.5));
                    $world->addParticle(new Vector3($x + 0.5, $y, $z), new HappyVillagerParticle($x - 0.5, $y, $z));
                    $world->addParticle(new Vector3($x, $y, $z + 0.5), new HappyVillagerParticle($x, $y, $z - 0.5));
                break;

                case self::PARTICLE_BLAZE:
                    $world->addParticle(new Vector3($x - 0.5, $y, $z), new FlameParticle($x + 0.5, $y, $z));
                    $world->addParticle(new Vector3($x, $y, $z - 0.5), new FlameParticle($x, $y, $z + 0.5));
                    $world->addParticle(new Vector3($x + 0.5, $y, $z), new FlameParticle($x - 0.5, $y, $z));
                    $world->addParticle(new Vector3($x, $y, $z + 0.5), new FlameParticle($x, $y, $z - 0.5));
                break;

                case self::PARTICLE_HEART:
                    $world->addParticle(new Vector3($x - 0.5, $y, $z), new HeartParticle());
                    $world->addParticle(new Vector3($x, $y, $z - 0.5), new HeartParticle());
                    $world->addParticle(new Vector3($x + 0.5, $y, $z), new HeartParticle());
                    $world->addParticle(new Vector3($x, $y, $z + 0.5), new HeartParticle());
                break;

                default:
                    $world->addParticle(new Vector3($x - 0.5, $y, $z), new AngryVillagerParticle($x + 0.5, $y, $z));
                    $world->addParticle(new Vector3($x, $y, $z - 0.5), new AngryVillagerParticle($x, $y, $z + 0.5));
                    $world->addParticle(new Vector3($x + 0.5, $y, $z), new AngryVillagerParticle($x - 0.5, $y, $z));
                    $world->addParticle(new Vector3($x, $y, $z + 0.5), new AngryVillagerParticle($x, $y, $z - 0.5));
                break;
            }
        }
    }

    /**
     * @param Entity $entity
     * @param float $trampolineJump
     * @return Vector3|null
     */
    public function addReboundTrampoline(Entity $entity, float $trampolineJump): ?Vector3{
        if($entity instanceof Living){
            $entity->setMotion(new Vector3(0, $trampolineJump, 0));
            $this->cancel_fall_damage[$entity->getName()] = true;
        }
        return null;
    }

    /**
     * @param string $worldName
     * @return array|null
     */
    public function trampolinePerWorlds(string $worldName): ?array{
        $settings = LP::getInstance()->config->getNested("Trampoline.trampoline");
        if(isset($settings[$worldName]["height"])){
            $config = [
                "height" => (float) $settings[$worldName]["height"],
                "soundName" => isset($settings[$worldName]["soundName"]) ? $settings[$worldName]["soundName"] : "mob.blaze.shoot",
                "soundPitch" => isset($settings[$worldName]["soundPitch"]) ? (float) $settings[$worldName]["soundPitch"] : 1.0,
            ];
        }else{
            $defaultSettings = [
                "height" => (float) ($settings["default-settings"]["height"] ?? 2.0),
                "soundName" => "mob.blaze.shoot",
                "soundPitch" => 1.0,
            ];
            $config = $defaultSettings;
        }
        return $config;
    }  

    /**
     * @param integer $id
     * @param string $type
     * @param string $worldName
     * @return array|null
     */
    public function launchpadPerWorlds(int $id, string $type, string $worldName): ?array{ 
        $settings = LP::getInstance()->config->getNested("LaunchPad.launchpad.{$id}.{$type}");
        if(isset($settings[$worldName]["knockback"])){
            $config = [
                "knockback" => (float) $settings[$worldName]["knockback"],
                "height" => isset($settings[$worldName]["height"]) ? (float) $settings[$worldName]["height"] : 2.0,
                "soundName" => isset($settings[$worldName]["soundName"]) ? $settings[$worldName]["soundName"] : "mob.irongolem.walk",
                "soundPitch" => isset($settings[$worldName]["soundPitch"]) ? (float) $settings[$worldName]["soundPitch"] : 1.0,
            ];
        }else{
            $defaultSettings = [
                "knockback" => 2.0,
                "height" => 2.0,
                "soundName" => "mob.irongolem.walk",
                "soundPitch" => 1.0,
            ];
            $config = array_merge($defaultSettings, $settings["default-settings"] ?? []);
        }
        return $config;
    }

    /**
     * @param Player $player
     * @return boolean
     */
    public function getWorldsEnabled(Player $player): bool{
        $mode = LP::getInstance()->config->getNested("Settings.WorldManager.mode");
        switch(strtolower($mode)){
            case self::BLACKLIST:
                if($this->isBlacklistMode($player->getWorld()->getFolderName())){
                    return false;
                }
            break;
    
            case self::WHITELIST:
                if(!$this->isWhitelistMode($player->getWorld()->getFolderName())){
                    return false;
                }
            break;
    
            default:
                return $this->isWhitelistMode($player->getWorld()->getFolderName());
        }
        return true;
    }
    
    /**
     * @param string $worldName
     * @return boolean
     */
    public function isWhitelistMode(string $worldName): bool{
        $worldsWhitelist = LP::getInstance()->config->getNested("Settings.WorldManager.worlds-whitelist");
        return in_array($worldName, $worldsWhitelist);
    }
    
    /**
     * @param string $worldName
     * @return boolean
     */
    public function isBlacklistMode(string $worldName): bool{
        $worldsBlacklist = LP::getInstance()->config->getNested("Settings.WorldManager.worlds-blacklist");
        return !in_array($worldName, $worldsBlacklist);
    }

    /**
     * @return self
     */
    public static function getInstance(): self{
        if(is_null(self::$instance)) self::$instance = new self();
        return self::$instance;
    }
}