<?php

namespace avenda;

use pocketmine\inventory\BaseInventory;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\inventory\InventoryPickupItemEvent;
use pocketmine\inventory\PlayerInventory;
use pocketmine\Player;
use pocketmine\entity\object\ItemEntity;

class Inv extends PluginBase implements Listener {
    public $ids = [];
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function pickupitem (InventoryPickupItemEvent $event) {
        $inv = $event->getInventory();
        $item = $event->getItem();
        if($inv instanceof PlayerInventory){
            $player = $inv->getHolder();
            $name = strtolower($player->getName());
            $this->ids[] = $name;
            $this->ids[$name] = [];
            for($i = 0; $i < 36; $i++) {
                if ($player->getInventory()->isSlotEmpty($i) == false) {//칸이 비어있지 않다면
                    array_push($this->ids[$name], "true");//아이템이있음
                } else {
                    array_push($this->ids[$name], "false");//아이템이없음
                }
            }
            if (! in_array("false", $this->ids[$name])) {
           /* if ($player->getInventory()->contains($item)) {
                $id = $item->getId();
                $damage = $item->getDamage();
                $count = $item->getCount();
                $player->getInventory()->addItem(Item::get($id, $damage, $count));
                return false;
            }*/ //ToDo
                
                $player->sendPopup("Your Inventory is Full, Please empty Your Inventory");
            }
        }
    }
}
