# LaunchACM
[![](https://poggit.pmmp.io/shield.state/LaunchACM)](https://poggit.pmmp.io/p/LaunchACM)

[![](https://poggit.pmmp.io/shield.api/LaunchACM)](https://poggit.pmmp.io/p/LaunchACM)

The best launchpad for PocketMine-MP 5.0, easy to use.
Add a setback and height settings for the launchpads and 
trampoline. Add fun sounds that you can configure in the 'config.yml'. 
[sounds minecraft](https://www.digminecraft.com/lists/sound_list_pe.php)

![Captura de pantalla 2023-08-02 071644](https://github.com/fernanACM/LaunchACM/assets/83558341/1d77b644-204c-416d-86d1-ad4cabd313a3)
<a href="https://discord.gg/YyE9XFckqb"><img src="https://img.shields.io/discord/837701868649709568?label=discord&color=7289DA&logo=discord" alt="Discord" /></a>

### 🌍 Wiki
* Check our plugin [wiki](https://github.com/fernanACM/LaunchACM/wiki) for features and secrets in the...

### 💡 Implementations
* [X] Configuration
* [x] Sounds
* [x] New launchpads
* [X] New trampoline
---

### 💾 Config
```yaml
   #   _                                      _          _       ____   __  __ 
#  | |       __ _   _   _   _ __     ___  | |__      / \     / ___| |  \/  |
#  | |      / _` | | | | | | '_ \   / __| | '_ \    / _ \   | |     | |\/| |
#  | |___  | (_| | | |_| | | | | | | (__  | | | |  / ___ \  | |___  | |  | |
#  |_____|  \__,_|  \__,_| |_| |_|  \___| |_| |_| /_/   \_\  \____| |_|  |_|
                                                                          
#           by fernanACM
# The best launchpad for PocketMine-MP 5.0, easy to use.
# Add a setback and height settings for the launchpads and 
# trampoline. Add fun sounds that you can configure in the 'config.yml'. 
# This is the sounds page: https://www.digminecraft.com/lists/sound_list_pe.php

# DO NOT TOUCH!
config-version: "1.0.0"

# ==(CONFIGURATION)==
Settings:
  # Particle systems in the launchpad and trampoline
  # Valid modes:
  # - happy
  # - blaze
  # - heart
  # - angry
  particle-type: heart
  # Activate/deactivate particle systems on the launchpad and trampoline
  # Use "true" or "false" to enable/disable this option
  particle: true
  # ==(SOUNDS)==
  # Use "true" or "false" to enable/disable this option
  launchpad-no-sound: true
  # Use "true" or "false" to enable/disable this option
  trampoline-no-sound: true
  # ==(WORLD MANAGER)==
  # Enable and disable launchpads and trampoline for worlds you 
  # add to "whitelist" or "blacklist" modes
  WorldManager:
    # Valid modes:
    # - whitelist
    # - blacklist
    mode: whitelist
    # Add the names of worlds that are in the whitelist
    worlds-whitelist:
      - "world"
      - "world-2"
      - "ACM"
    # Add the names of worlds that are in the blacklist
    worlds-blacklist:
      - "MinePvP"
      - "ZonePvP"

# ==(TRAMPOLINE)==
Trampoline:
  # Default setting in case you haven't 
  # added "height", "soundName" or "soundPitch"
  default-settings:
    # Height has reach on the trampoline.
    height: 3.0
    # Sound when being propelled by the trampoline
    # https://www.digminecraft.com/lists/sound_list_pe.php
    soundName: "mob.blaze.shoot"
    # Sound distortion
    soundPitch: 2.4
  # Enable/disable trampoline
  # Use "true" or "false" to enable/disable this option
  trampoline-use: true
  # ==(TRAMPOLINE FOR WORLDS)==
  # This is a boost customization feature on the trampoline
  trampoline:
    # [EXAMPLE]:
    # worldName:
    #   height: 3
    #   soundName: "mob.blaze.hit"
    #   soundPitch: 2
    
    # Remember that "soundName" and "soundPitch" are optional, 
    # but you can use them if you want to make it much nicer.
    world:
      height: 2
      soundName: "mob.blaze.shoot"
      soundPitch: 1.3
    world_2:
      height: 3
      soundName: "mob.blaze.shoot"
      soundPitch: 16.4
   
# ==(LAUNCHPADS)==
LaunchPad:
  # Enable/disable launchpads
  # Use "true" or "false" to enable/disable this option
  LaunchPads:
    # Type: stone
    stone_pressure_plate: true
    # Type: acacia
    acacia_pressure_plate: true
    # Type: birch
    birch_pressure_plate: true
    # Type: dark_oak
    dark_oak_pressure_plate: true
    # Type: jungle
    jungle_pressure_plate: true
    # Type: oak
    oak_pressure_plate: true
    # Type: spruce
    spruce_pressure_plate: true
    # Type: weighted_heavy
    weighted_pressure_plate_heavy: true
    # # Type: weighted_light
    weighted_pressure_plate_light: true
    # Type: polished
    polished_blackstone_pressure_plate: true
    # Type: mangrove
    mangrove_pressure_plate: true
    # Type: crimson
    crimson_pressure_plate: true
    # Type: warped
    warped_pressure_plate: true
    # Type: cherry
    cherry_pressure_plate: true

  
  launchpad:
    # Default setting in case you haven't 
    # added "knockback", "height", "soundName" or "soundPitch"
    default-settings:
      # Knockback that is triggered by the launchpad
      knockback: 2.0
      # Height has reach on the launchpad
      height: 3.0
      # Sound when being propelled by the launchpad
      # https://www.digminecraft.com/lists/sound_list_pe.php
      soundName: "mob.irongolem.walk"
      # Sound distortion
      soundPitch: 2.4
    # ==(LAUNCHPAD FOR WORLDS)==
    # This is a boost customization feature on the launchpad

    # [EXAMPLE]:
    # worldName:
    #   knockback: 3
    #   height: 3
    #   soundName: "mob.blaze.hit"
    #   soundPitch: 2
    
    # Remember that "soundName" and "soundPitch" are optional, 
    # but you can use them if you want to make it much nicer.
    0:
      stone_pressure_plate:
        world:
          knockback: 3
          height: 2
          soundName: "mob.irongolem.walk"
          soundPitch: 1.3
        world-2:
          knockback: 3
          height: 2
          soundName: "mob.irongolem.walk"
          soundPitch: 1.3
   ```
   
### 📞 Contact
| Redes | Tag | Link |
|-------|-------------|------|
| YouTube | fernanACM | [YouTube](https://www.youtube.com/channel/UC-M5iTrCItYQBg5GMuX5ySw) | 
| Discord | fernanACM#5078 | [Discord](https://discord.gg/YyE9XFckqb) |
| GitHub | fernanACM | [GitHub](https://github.com/fernanACM)
| Poggit | fernanACM | [Poggit](https://poggit.pmmp.io/ci/fernanACM)
****
