<?php
/**
 * Copyright (C) 2017 iiFlamiinBlaze
 *
 * iiFlamiinBlaze's plugins are licensed under a custom license!
 * -==+iiFlamiinBlaze PocketMine-MP Open Source Plugins License+==-
 *
 * Do not copy/copy and paste this code without permission from [iiFlamiinBlaze](https://github.com/iiFlamiinBlaze)!
 * You may fork this project, but make sure to give iiFlamiinBlaze and EruptusPE credit in plugin.yml and README.md!!
 * Using these plugins from Poggit is ok (if uploaded to poggit), just make sure to give iiFlamiinBlaze credit!
 * If anyone abuses/doesn't abide by this license, then you will be brought with a DCMA takedown!
 * Contact iiFlamiinBlaze: http://v.ht/epediscord
 *
 * All rights reserved to iiFlamiinBlaze!
 *
 * @author iiFlamiinBlaze
 * Twitter: https://twitter.com/iiFlamiinBlaze
 * GitHub: https://github.com/iiFlamiinBlaze
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

    public $config;
    public $prefix = TF::GOLD . "Fly" . TF::GREEN . " > " . TF::WHITE;


    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("AdvancedFly by iiFlamiinBlaze");
        $this->getLogger()->info($this->prefix."Activated");
    }

    public function onDamage(EntityDamageEvent $event){
        $entity = $event->getEntity();
            if ($entity instanceof Player) {
                if ($event instanceof EntityDamageByEntityEvent) {
                    $damager = $event->getDamager();
                    if ($damager instanceof Player) {
                            if ($damager->getAllowFlight()) {
                                $damager->sendMessage($this->prefix . TF::DARK_RED . "Fly disabled due to combat while flying!");
                                $damager->setAllowFlight(false);
                            }
                        }
                    }
                }
            }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        if ($player->hasPermission("fly.command")) {
            if ($player->getGamemode("survival")) {
                $player->setAllowFlight(false);
                $player->sendMessage($this->prefix . TF::RED . "Flight has been updated!");
            } else {
                ($player->getGamemode("creative")){
                $player->sendMessage($this->prefix . TF::GREEN . "Flight has not been updated!")};

            }
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
        if ($cmd->getName() == "fly") {
            if($sender instanceof Player) {
                if ($sender->hasPermission("fly.command")) {
                    if (!$sender->getAllowFlight()) {
                        $sender->setAllowFlight(true);
                        $sender->sendMessage($this->prefix . TF::GREEN . "You can now fly.");
                        return true;

                    } else {
                        if ($sender->getAllowFlight()) {
                            $sender->setAllowFlight(false);
                            $sender->sendMessage($this->prefix . TF::RED . "You can no longer fly.");
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
