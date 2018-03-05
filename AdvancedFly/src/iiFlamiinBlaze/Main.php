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

namespace iiFlamiinBlaze;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener{

    const PREFIX = TextFormat::GREEN . "AdvancedFly" . TextFormat::AQUA . " > " . TextFormat::WHITE;

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("AdvancedFly by iiFlamiinBlaze");
        $this->getLogger()->info(Main::PREFIX . "Activated");
    }

    public function onJoin(PlayerJoinEvent $event) : void{
        $player = $event->getPlayer();
        if(!$player->isCreative()){
            $player->setAllowFlight(false);
            $player->setFlying(false);
            $player->sendMessage(Main::PREFIX . TextFormat::RED . "Flight has been disabled!");
        }
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        if($command->getName() === "fly"){
            if(!$sender instanceof Player){
                $sender->sendMessage(TextFormat::RED . "Use this command in-game!");
                return false;
            }
            if($sender->hasPermission("fly.command")){
                if(!$sender->isCreative()){
                    if(!$sender->isFlying()){
                        $sender->setAllowFlight(true);
                        $sender->setFlying(true);
                        $sender->sendMessage(Main::PREFIX . TextFormat::GREEN . "Flight mode activated.");
                    }else{
                        $sender->setAllowFlight(false);
                        $sender->setFlying(false);
                        $sender->sendMessage(Main::PREFIX . TextFormat::RED . "Regular mode activated.");
                    }
                }else{
                    $sender->sendMessage(Main::PREFIX . TextFormat::RED . "You can only use this command in survival mode.");
                    return false;
                }
            }else{
                $sender->sendMessage(Main::PREFIX . TextFormat::RED . "You do not have permission to use this command");
                return false;
            }
        }
        return true;
    }

    public function onDamage(EntityDamageEvent $event) : void{
        $entity = $event->getEntity();
        if($entity instanceof Player){
            if($event instanceof EntityDamageByEntityEvent){
                $damager = $event->getDamager();
                if($damager instanceof Player){
                    if(!$damager->isCreative()){
                        if($damager->getAllowFlight()){
                            $damager->sendMessage(Main::PREFIX . TextFormat::DARK_RED . "Flight mode disabled due to combat!");
                            $damager->setAllowFlight(false);
                            $damager->setFlying(false);
                        }
                    }
                }
            }
        }
    }

    public function onDisable() : void{
        $this->getLogger()->info("AdvancedFly by iiFlamiinBlaze");
        $this->getLogger()->info(Main::PREFIX . "Deactivated");
    }
}
