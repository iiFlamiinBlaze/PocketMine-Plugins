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
use iiFlamiinBlaze\Selector;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\utils\TextFormat as TF;
use pocketmine\math\Vector3;
use pocketmine\inventory\Inventory;
use pocketmine\level\particle\LavaParticle;
use pocketmine\level\sound\EndermanTeleportSound;
/**
 * Using Item events
 */
use iiFlamiinBlaze\events\Item;

class PrisonTransfer extends PluginBase implements Listener
{

    public function __construct(Selector $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onPlayerInteract(PlayerInteractEvent $event){
        /**
         * On interact of the PrisonTransfer Item
         */
        $sender = $event->getPlayer();
        if ($sender instanceof Player) {
            if (!$sender->hasPermission("selector.use")) {
                $sender->sendMessage(TF::RED . ("You do not have permission to use Selector!"));
                return true;
            }
            if($sender->getLevel("world"){
            $inv = $sender->getInventory()}));
            if ($inv->contains(Item::get(101, 0, 1))) {
                $level = $sender->getLevel();
                $x = $sender->getX();
                $y = $sender->getY();
                $z = $sender->getZ();
                $pos = new Vector3($x, $y + 2, $z);
                $pos1 = new Vector3($x, $y, $z);
                $level->addSound(new EndermanTeleportSound($pos1));
                $level->addParticle(new LavaParticle($pos));
                $event->getPlayer()->teleport($this->getServer()->getLevelByName("prison")->getSafeSpawn());
                $inv->removeItem(Item::get(101, 0, 1));
            }
        }
        return true;
    }
}