<?php
declare(strict_types=1);
namespace ProxyTechDevs\CustomMobDropsPMMP\Main;
use pocketmine\entity\Human;
use pocketmine\entity\Living;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\Listener;
use pocketmine\item\Item;

class EventListener implements Listener {
	
	/** @var Main */
	public $plugin;
	
	public function __construct(Main $plugin){
		$this->plugin = $plugin;
	}
	
	public function onEntityDeath(EntityDeathEvent $ev){
		if(!($ev->getEntity() instanceof Human) && $ev->getEntity() instanceof Living){
			if(isset($this->plugin->config->getAll()[$ev->getEntity()::NETWORK_ID])){
				$arr = [];
				foreach($this->plugin->config->getAll()[$ev->getEntity()::NETWORK_ID] as $itemArr){
					$arr[] = Item::get($itemArr[0], $itemArr[1], $itemArr[2]);
				}
				$ev->setDrops($arr);
			}
		}
	}
}
