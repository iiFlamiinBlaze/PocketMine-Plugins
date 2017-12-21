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

namespace iiFlamiinBlaze;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\utils\TextFormat as TF;

class AdvancedFly extends PluginBase implements Listener{

    public $prefix = TF::GREEN . "Fly" . TF::AQUA . " > " . TF::WHITE;


    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("AdvancedFly by iiFlamiinBlaze");
        $this->getLogger()->info($this->prefix."Activated");
    }

    public function onDamage(EntityDamageEvent $event)
    {
        $entity = $event->getEntity();
        if ($entity instanceof Player) {
            if ($event instanceof EntityDamageByEntityEvent) {
                $damager = $event->getDamager();
                if ($damager instanceof Player) {
                    if ($damager->getGamemode("survival")) {
                        if ($damager->getAllowFlight()) {
                            $damager->sendMessage($this->prefix . TF::DARK_RED . "Fly disabled due to combat while flying!");
                            $damager->setAllowFlight(false);
                        }
                    }
                }
            }
        }
    }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        if ($player->hasPermission("fly.command")) {
            /**
             * onJoin if in survival mode = setAllowFlight false
             */
            if ($player->getGamemode("survival")) {
                $player->getAllowFlight();
                $player->setAllowFlight(false);
                $player->sendMessage($this->prefix . TF::RED . "You are now in Regular Mode.");
            }
        }
    }


    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
        switch ($cmd->getName()) {
            case "fly":
            if($sender instanceof Player) {
                if ($sender->hasPermission("fly.command")) {
                    if (!$sender->getAllowFlight()) {
                        $sender->setAllowFlight(true);
                        $sender->sendMessage($this->prefix . TF::GREEN . "You are now in Flight Mode.");
                        return true;

                    } else {
                        if ($sender->getAllowFlight()) {
                            $sender->setAllowFlight(false);
                            $sender->sendMessage($this->prefix . TF::RED . "You are now in Regular Mode.");
                            return true;
                        }
                    }
                }
            } else {
                $sender->sendMessage($this->prefix .TF::DARK_RED."This command is only available in-game!");
                return true;
            }
        }
        return true;
    }

    public function onDisable() {
        $this->getLogger()->info("AdvancedFly by iiFlamiinBlaze");
        $this->getLogger()->info($this->prefix ."Deactivated");
    }
}
