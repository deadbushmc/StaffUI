<?php

namespace DeadBush\StaffUI;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args): bool {
		
		switch($cmd->getName()){
			case "staff":
			if($sender instanceof Player){
				if($sender->hasPermission("staffui.use")){
					$this->staff($sender);
				}else{
					$sender->sendMessage("§4You Don't Have Permission To Use This Command");
				}
			}
		}
	return true;
	}

	public function staff($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){
			if($data === null){
				return true;
			}
		switch($data){
			case 0:
			    $this->kick($player);
			break;
			
			case 1:
			    $this->ban($player);
			break;
			
			case 2:
			    $this->unban($player);
			break;
			
			case 3:
			    $this->gamemodeui($player);
			break;
			
			case 4:
			    $this->getServer()->dispatchCommand($player, "vanish");
			break;
			
		    case 5:
	            $this->inv($player);
	        break;
		}
		});
		$form->setTitle("§l§4STAFF §eUI§r");
		$form->setContent("§eModeration Controls For Staffs");
		$form->addButton("§lKick Player");
		$form->addButton("§lBan Player");
		$form->addButton("§lUnban Player");
		$form->addButton("§lGamemode");
		$form->addButton("§lVanish");
		$form->addButton("§lSee Inv");
		$form->sendToPlayer($player);
		return $form;
	}

	public function kick($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			$this->getServer()->dispatchCommand($player, "kick " . $data[0] . " " . $data[1]);
		});
		$form->setTitle("§l§4KICK");
		$form->addInput("§eEnter The Player Name To Kick");
		$form->addInput("§eEnter A Reason For Kick");
		$form->sendToPlayer($player);
		return $form;
	}

	public function ban($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			$this->getServer()->dispatchCommand($player, "ban " . $data[0] . " " . $data[1]);
		});
		$form->setTitle("§l§4BAN");
		$form->addInput("§eEnter The Player Name To Ban");
		$form->addInput("§eEnter A Reason For Ban");
		$form->sendToPlayer($player);
		return $form;
	}

	public function unban($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			$this->getServer()->dispatchCommand($player, "unban " . $data[0]);
		});
		$form->setTitle("§l§4UN_BAN");
		$form->addInput("§eEnter The Player Name To UnBan");
		$form->sendToPlayer($player);
		return $form;
	}

	public function gamemodeui($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){
			if($data === null){
				return true;
			}
	    switch($data){
	    	case 0:
	    	    $this->getServer()->dispatchCommand($player, "gamemode creative");
	    	break;

	    	case 1:
	    	    $this->getServer()->dispatchCommand($player, "gamemode survival");
	    	break;

	    	case 2:
	    	    $this->getServer()->dispatchCommand($player, "gamemode spectator");
	    	break;
	    }
		});
		$form->setTitle("§l§4GAMEMODE");
		$form->addButton("§lCreative");
		$form->addButton("§lSurvival");
		$form->addButton("§lSpectator");
		$form->sendToPlayer($player);
		return $form;
	}

	public function inv($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){
			if($data === null){
				return true;
			}
		switch($data){
			case 0:
			    $this->invsee($player);
			break;

			case 1:
			    $this->enderinv($player);
			break;
		}
		});
		$form->setTitle("§l§4SEE-INV");
		$form->addButton("§eSee Inv");
		$form->addButton("§lSee EnderChest");
		$form->sendToPlayer($player);
		return $form;
	}

	public function invsee($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			$this->getServer()->dispatchCommand($player, "invsee " . $data[0]);
		});
		$form->setTitle("§l§4INV");
		$form->addInput("§eEnter The Player Name To See-Inv");
		$form->sendToPlayer($player);
		return $form;
	}

	public function enderinv($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			$this->getServer()->dispatchCommand($player, "enderinvsee " . $data[0]);
		});
		$form->setTitle("§l§4INV");
		$form->addInput("§eEnter The Player Name To See EnderChest");
		$form->sendToPlayer($player);
		return $form;
	}
}