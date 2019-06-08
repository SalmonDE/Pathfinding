<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar;

use pocketmine\block\Block;

class DefaultCostCalculator extends CostCalculator {

	public function getCost(Block $block): float{
		switch($block->getId()){
			case Block::WATER:
			case Block::FLOWING_WATER:
				return 2.0;
			case Block::COBWEB:
				return 3.0;
			default:
				return 1.0;
		}
	}
}
