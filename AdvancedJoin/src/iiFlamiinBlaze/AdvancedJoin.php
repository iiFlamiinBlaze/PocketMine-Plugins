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

namespace iiFlamiinBlaze;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\player\PlayerJoinEvent;

class AdvancedJoin extends PluginBase implements Listener{

    const VERSION = "v1.0";

    public function onEnable() : void{
        $this->getLogger()->info("AdvancedJoin by iiFlamiinBlaze enabled!");
        $this->saveDefaultConfig();
    }

    public function onJoin(PlayerJoinEvent $event) : void{
        $player = $event->getPlayer();
        $config = $this->getConfig();
        $title2 = str_replace("&", "§", $config->get("title"));
        $title = str_replace("%p", $player->getName(), $title2);
        $subtitle = str_replace("&", "§", $config->get("subtitle"));

        $player->addTitle($title, $subtitle, 80, 100, 40);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        switch($command->getName()){
            case "titlejoin":
                if(!isset ($args[0])){
                    $sender->sendMessage(TextFormat::GRAY . "Usage: /titlejoin about");
                }
                if(!$sender instanceof Player){
                    $sender->sendMessage(TextFormat::RED . "Use this command in-game!");
                }
                if($args[0] === "about"){
                    if($sender->hasPermission("advancedjoin.command")){
                        $sender->sendMessage(TextFormat::DARK_GRAY . "-=========AdvancedJoin " . AdvancedJoin::VERSION . " =========-");
                        $sender->sendMessage(TextFormat::GREEN . "Author: iiFlamiinBlaze");
                        $sender->sendMessage(TextFormat::GREEN . "GitHub: https://github.com/iiFlamiinBlaze");
                        $sender->sendMessage(TextFormat::GREEN . "Support: https://bit.ly/epediscord");
                        $sender->sendMessage(TextFormat::GREEN . "Description: Allows you to customize a title for your players to see when they join your server!");
                        $sender->sendMessage(TextFormat::DARK_GRAY . "-===============================-");
                    }else{
                        $config = $this->getConfig();
                        $message = str_replace("&", "§", $config->get("no_permission"));
                        $sender->sendMessage($message);
                    }
                }
                break;
        }
        return true;
    }

    public function onDisable() : void{
        $this->getLogger()->info("AdvancedJoin by iiFlamiinBlaze disabled!");
    }
}