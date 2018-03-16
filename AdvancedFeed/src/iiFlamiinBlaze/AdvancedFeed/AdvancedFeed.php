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
declare(strict_types=1);

namespace iiFlamiinBlaze\AdvancedFeed;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

class AdvancedFeed extends PluginBase{

    const VERSION = "v1.1";
    const PREFIX = TextFormat::AQUA . "AdvancedFeed" . TextFormat::GOLD . " > ";

    public function onEnable() : void{
        $this->getLogger()->info(AdvancedFeed::PREFIX . "AdvancedFeed  " . AdvancedFeed::VERSION . " by iiFlamiinBlaze is enabled!");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        if($command->getName() === "feed"){
            if(!$sender instanceof Player){
                $sender->sendMessage(TextFormat::RED . "Use this command in-game");
                return false;
            }
            if(!isset($args[0])){
                $sender->sendMessage(TextFormat::GRAY . "Usage: /feed <player>");
                return false;
            }
            if($sender->hasPermission("feed.command")){
                $player = $this->getServer()->getPlayer($args[0]);
                if($player){
                    $player->setFood(20);
                    $player->setSaturation(20);
                    $player->sendMessage(AdvancedFeed::PREFIX . TextFormat::GREEN . "You have now been fed!");
                    $sender->sendMessage(AdvancedFeed::PREFIX . TextFormat::GREEN . "You have fed " . $player->getName() . ".");
                }else{
                    $sender->sendMessage(AdvancedFeed::PREFIX . TextFormat::RED . "Player not found.");
                    return false;
                }
            }else{
                $sender->sendMessage(AdvancedFeed::PREFIX . TextFormat::RED . "You do not have permission to use this command.");
                return false;
            }
        }
        return true;
    }
}
