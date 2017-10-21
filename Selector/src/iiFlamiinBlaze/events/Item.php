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
            $player->sendPopup("§7[§6EruptusPE§7]\n§a Prison\n§b Tap to transfer to server")});
        }
        elseif($item->getId() == 369){
            if($player->getLevel("world"){
            $player->sendPopup("§7[§6EruptusPE§7]\n§a Minigames\n§b Tap to transfer to server")});
        }
        elseif($item->getId() == 418){
            if($player->getLevel("world"){
            $player->sendPopup("§7[§6EruptusPE§7]\n§a Creative\n§b Tap to transfer to server")});
        }
        elseif($item->getId() == 351){
            if($player->getLevel("world"){
            $player->sendPopup("§7[§6EruptusPE§7]\n§a Coming Soon\n§b Tap to transfer to server")});
        }
        return true;
    }
}
