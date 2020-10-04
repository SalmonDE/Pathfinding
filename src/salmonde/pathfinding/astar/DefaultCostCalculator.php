<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar;

use pocketmine\block\Block;
use pocketmine\block\BlockLegacyIds as Ids;

class DefaultCostCalculator extends CostCalculator {

	public function getCost(Block $block): float{
		switch($block->getId()){
			case Ids::WATER:
			case Ids::FLOWING_WATER:
				return 2.0;
			case Ids::COBWEB:
				return 3.0;
			default:
				return 1.0;
		}
	}
}
