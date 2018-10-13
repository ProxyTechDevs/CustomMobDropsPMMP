<?php
declare(strict_types=1);
namespace ProxyTechDevs\CustomMobDropsPMMP\Main;

use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase{

	/** @var Config */
	public $config;

	public function onEnable(){
		@mkdir($this->getDataFolder());
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, [
			"" => [
				[
					"ITEM ID",
					"DAMAGE",
					"COUNT"
				],
				[
					"ITEM ID",
					"DAMAGE",
					"COUNT"
				],
			],
			12 => [
				[Item::CHAIN_HELMET, 0, 16],
				[Item::PAPER, 0, 24],
			]
		]);
		if(!is_file($this->getDataFolder() . "config.yml")){
			$this->config->save();
		}
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
	}
}
