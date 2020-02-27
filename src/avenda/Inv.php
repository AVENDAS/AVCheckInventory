<?php

namespace avenda;

use pocketmine\inventory\BaseInventory;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\inventory\InventoryPickupItemEvent;
use pocketmine\inventory\PlayerInventory;

class Inv extends PluginBase implements Listener {
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function pickupitem (InventoryPickupItemEvent $event) {
        $inv = $event->getInventory();
        $item = $event->getItem();
        if($inv instanceof PlayerInventory){
            $player = $inv->getHolder();
            if ($player->getInventory()->canAddItem($item) == false){
                $player->sendPopup("Your Inventory is Full, Please empty Your Inventory");
            }
        }
    }
}
