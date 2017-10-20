<?php
/**
 * Copyright (C) 2017 iiFlamiinBlaze
 *
 * Selector by iiFlamiinBlaze is licensed under a custom license!
 * -==iiFlamiinBlaze's Selector Plugin License==-
 * Do not copy/copy and paste this code without permission from iiFlamiinBlaze!
 * You may fork this project, but make sure to give iiFlamiinBlaze credit!
 * Using this plugin from Poggit is ok, just make sure to give iiFlamiinBlaze credit!
 * Anyone associated with leet.cc (beetree, spajk, MrCakeSlayer etc.) MAY NOT use this plugin!!
 * Contact iiFlamiinBlaze: v.ht/epediscord
 * All rights reserved to iiFlamiinBlaze!
 *
 * @author iiFlamiinBlaze
 * Twitter: https://twitter.com/iiFlamiinBlaze
 * GitHub: https://github.com/iiFlamiinBlaze
 */

namespace iiFlamiinBlaze\events;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\math\Vector3;
use pocketmine\inventory\Inventory;
use pocketmine\level\particle\LavaParticle;
use pocketmine\level\sound\EndermanTeleportSound;

class JoinEvent extends PluginBase implements Listener
{

    public function __construct(Selector $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onJoin(PlayerJoinEvent $event)
    {
        /**
         * Gives compass onJoin in main world
         */
        $sender = $event->getPlayer();
        if ($sender instanceof Player) {
            if (!$sender->hasPermission("selector.use")) {
                $sender->sendMessage(TF::RED . ("You do not have permission to use Selector!"));
                return true;
            }
            if($sender->getLevel("world"){
            $inv = $sender->getInventory()}));
            if ($inv->contains(Item::get(345, 0, 1))){
                $inv->removeItem(Item::get(345, 0, 1));
            } else {
                $inv->addItem(Item::get(345, 0, 1));
                $sender->sendMessage("§aObtained Teleportation Compass!");
            }
        }
        return true;
    }
}
