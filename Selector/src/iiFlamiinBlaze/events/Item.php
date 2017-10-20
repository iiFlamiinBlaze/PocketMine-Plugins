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

/**
 * Using pocketmine events
 */
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as TF;
use pocketmine\inventory\Inventory;
use pocketmine\event\player\PlayerItemHeldEvent;

class Item extends PluginBase implements Listener{
    public $plugin;

    public function __construct($plugin){
        $this->plugin = $plugin;
    }

    public function onItemHeld(PlayerItemHeldEvent $event){
        $item = $event->getItem();
        $player = $event->getPlayer();
        $inv = $player->getInventory();
        if (!$player->hasPermission("selector.use")) {
            $player->sendMessage(TF::RED . ("You do not have permission to use Selector!"));
            return true;
        }
        if($item->getId() == 101){
            if($player->getLevel("world"){
            $player->sendPopup("§7[§6EruptusPE§7]\n§a Prison\n§b Tap to transfer to server")}));
        }
        elseif($item->getId() == 369){
            if($player->getLevel("world"){
            $player->sendPopup("§7[§6EruptusPE§7]\n§a Minigames\n§b Tap to transfer to server")}));
        }
        elseif($item->getId() == 418){
            if($player->getLevel("world"){
            $player->sendPopup("§7[§6EruptusPE§7]\n§a Creative\n§b Tap to transfer to server")}));
        }
        elseif($item->getId() == 351){
            if($player->getLevel("world"){
            $player->sendPopup("§7[§6EruptusPE§7]\n§a Coming Soon\n§b Tap to transfer to server")}));
        }
        return true;
    }
}
