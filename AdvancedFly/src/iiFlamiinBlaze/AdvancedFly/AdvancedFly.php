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

namespace iiFlamiinBlaze\AdvancedFly;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\utils\TextFormat;

class AdvancedFly extends PluginBase implements Listener{

    const PREFIX = TextFormat::GREEN . "AdvancedFly" . TextFormat::AQUA . " > " . TextFormat::WHITE;

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getLogger()->info(AdvancedFly::PREFIX . "AdvancedFly by iiFlamiinBlaze enabled");
    }

    public function onJoin(PlayerJoinEvent $event) : void{
        $player = $event->getPlayer();
        $config = $this->getConfig();
        if($config->getNested("onJoin_FlyReset") === true){
            if(!$player->isCreative()){
                $player->setAllowFlight(false);
                $player->setFlying(false);
                $player->sendMessage(AdvancedFly::PREFIX . TextFormat::RED . "Flight has been disabled.");
            }
        }
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        if($command->getName() === "fly"){
            if(!$sender instanceof Player){
                $sender->sendMessage(TextFormat::RED . "Use this command in-game.");
                return false;
            }
            if($sender->hasPermission("fly.command")){
                if(!$sender->isCreative()){
                    if(!$sender->getAllowFlight()){
                        $sender->setAllowFlight(true);
                        $sender->setFlying(true);
                        $sender->sendMessage(AdvancedFly::PREFIX . TextFormat::GREEN . "Flight mode activated.");
                    }else{
                        $sender->setAllowFlight(false);
                        $sender->setFlying(false);
                        $sender->sendMessage(AdvancedFly::PREFIX . TextFormat::RED . "Regular mode activated.");
                    }
                }else{
                    $sender->sendMessage(AdvancedFly::PREFIX . TextFormat::RED . "You can only use this command in survival mode.");
                    return false;
                }
            }else{
                $sender->sendMessage(AdvancedFly::PREFIX . TextFormat::RED . "You do not have permission to use this command");
                return false;
            }
        }
        return true;
    }

    public function onDamage(EntityDamageEvent $event) : void{
        $entity = $event->getEntity();
        $config = $this->getConfig();
        if($config->getNested("onDamage_FlyReset") === true){
            if($entity instanceof Player){
                if($event instanceof EntityDamageByEntityEvent){
                    $damager = $event->getDamager();
                    if($damager instanceof Player){
                        if(!$damager->isCreative()){
                            if($damager->getAllowFlight()){
                                $damager->sendMessage(AdvancedFly::PREFIX . TextFormat::DARK_RED . "Flight mode disabled due to combat.");
                                $damager->setAllowFlight(false);
                                $damager->setFlying(false);
                            }
                        }
                    }
                }
            }
        }
    }
}
