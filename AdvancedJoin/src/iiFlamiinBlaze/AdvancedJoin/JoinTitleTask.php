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

namespace iiFlamiinBlaze\AdvancedJoin;

use pocketmine\Player;
use pocketmine\scheduler\PluginTask;

class JoinTitleTask extends PluginTask{

    private $main;
    private $player;

    public function __construct(AdvancedJoin $main, Player $player){
        $this->main = $main;
        $this->player = $player;
        parent::__construct($main);
    }

    public function onRun(int $currentTick){
        $config = $this->main->getConfig();
        $title = str_replace("&", "§", $config->get("title"));
        $title = str_replace("%p", $this->player->getName(), $title);
        $subtitle = str_replace("&", "§", $config->get("subtitle"));
        $this->player->addTitle($title, $subtitle);
    }
}