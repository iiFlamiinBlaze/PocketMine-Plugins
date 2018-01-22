<?php
/**
 * Copyright (C) 2017 iiFlamiinBlaze
 *
 * iiFlamiinBlaze's plugins are licensed under GPL-3.0 license!
 * Made by iiFlamiinBlaze for the PocketMine-MP Community!
 *
 * @author iiFlamiinBlaze
 * Twitter: https://twitter.com/iiFlamiinBlaze
 * GitHub: https://github.com/iiFlamiinBlaze
 * Discord: https://bit.ly/epediscord
 */
namespace AdvancedFeed;

use pocketmine\event\entity\EntityEatEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;

class AdvancedFeed extends PluginBase{

    public $version = "v1.0";

    public function onEnable(){
        $this->getLogger()->info("AdvancedFeed $version by iiFlamiinBlaze is loading...");
        $this->getLogger()->info("AdvancedFeed $version by iiFlamiinBlaze is enabled!");
    }

    public function onDisable(){
        $this->getLogger()->info("AdvancedFeed $version by iiFlamiinBlaze is disabled!");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
        switch ($cmd->getName()) {
            case "feed":
                if($sender->hasPermission("feed.command")){
                    if($sender instanceof Player){
                        $sender->setFoodRestore(20);
                        $sender->setSaturationRestore(20);
                        $sender->addTitle("§aYou have now been fed $sender!");
                    }
                }
                break;
        }
        return true;
    }
}
