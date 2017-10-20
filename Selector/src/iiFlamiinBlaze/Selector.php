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
 * Anyone associated with leet.cc (beetree, spajk, MrCakeSlayer, Brodlum, OneThousand etc.) MAY NOT use this plugin!!! If LEET does use this plugin, a DCMA takedown will be brought!!
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

/**
 * Using pocketmine events
 */

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\math\Vector3;
use pocketmine\inventory\Inventory;
use pocketmine\level\particle\LavaParticle;
use pocketmine\level\sound\EndermanTeleportSound;

/**
 * Using transfer events
 */

use iiFlamiinBlaze\events\Item;
use iiFlamiinBlaze\events;

class Selector extends PluginBase implements Listener
{
    public $plugin;
    public $sender;

    public static function getPlugin(): Selector {
        return self::$plugin;
    }


    public function onEnable()
    {

        $this->getLogger()->info(TF::GREEN . "Selector has been enabled successfully!");
        $this->getLogger()->info(TF::GREEN . "Selector made by iiFlamiinBlaze!");
        $this->getLogger()->info(TF::GREEN . "Website: http://EruptusPE.tk");
        /**
         * Register events
         */
        $this->getServer()->getPluginManager()->registerEvents(new events\JoinEvent($plugin), $this);
        $this->getServer()->getPluginManager()->registerEvents(new events\MinigamesTransfer($plugin), $this);
        $this->getServer()->getPluginManager()->registerEvents(new events\CreativeTransfer($plugin), $this);
        $this->getServer()->getPluginManager()->registerEvents(new events\PrisonTransfer($plugin), $this);
        $this->getServer()->getPluginManager()->registerEvents(new events\Item($plugin), $this);
    }

    public function onDisable()
    {
        $this->getLogger()->info(TF::RED . "Disabling...!");
        $this->getLogger()->info(TF::RED . "Selector by iiFlamiinBlaze has been Disabled successfully!");
    }

    public function onPlayerInteract(PlayerInteractEvent $event)
    {
        /**
         * On interact of the compass in main world
         */
        $sender = $event->getPlayer();
        if ($sender instanceof Player) {
            if (!$sender->hasPermission("selector.use")) {
                $sender->sendMessage(TF::RED . ("You do not have permission to use Selector!"));
                return true;
            }
            $inv = $sender->getInventory();
            if ($inv->contains(Item::get(345, 0, 1))) {
                $level = $sender->getLevel();
                $x = $sender->getX();
                $y = $sender->getY();
                $z = $sender->getZ();
                $pos = new Vector3($x, $y + 2, $z);
                $pos1 = new Vector3($x, $y, $z);
                $level->addSound(new EndermanTeleportSound($pos1));
                $level->addParticle(new LavaParticle($pos));
                if($sender->getLevel("world"){
                $inv->removeItem(Item::get(345, 0, 1)){
                $inv->addItem(Item::get(101, 0, 1))}}));
                $inv->addItem(Item::get(369, 0, 1));
                $inv->addItem(Item::get(418, 0, 20));
                $inv->addItem(Item::get(351, 8, 1));
                $sender->sendMessage(TF::GREEN . "Tap the items below to transfer to that server!");
            }
        }
        return true;
    }
}
