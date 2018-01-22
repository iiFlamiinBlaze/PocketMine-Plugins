<?php
/**
 * Copyright (C) 2018 iiFlamiinBlaze
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

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

class AdvancedFeed extends PluginBase{

    const VERSION = "v1.1";

    public function onEnable(): void{
        $this->getLogger()->info("AdvancedFeed  " . AdvancedFeed::VERSION . " by iiFlamiinBlaze is enabled!");
    }

    public function onDisable(): void{
        $this->getLogger()->info("AdvancedFeed " . AdvancedFeed::VERSION . " by iiFlamiinBlaze is disabled!");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
        switch($cmd->getName()){
            case "feed":
                if(!$sender instanceof Player){
                    $sender->sendMessage(TextFormat::RED . "Use this command in-game");
                }
                if($sender->hasPermission("feed.command")){
                    $sender->setFood(20);
                    $sender->setSaturation(20);
                    $sender->sendMessage(TextFormat::GREEN . "You have now been fed!");
                }else{
                    $sender->sendMessage(TextFormat::RED . "You do not have permission to use this command.");
                }
                break;
        }
        return true;
    }
}
