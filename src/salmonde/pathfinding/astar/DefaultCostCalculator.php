<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar;

use pocketmine\block\Block;

class DefaultCostCalculator extends CostCalculator {

	public function getCost(Block $block): float{
		switch($block->getId()){
			case Block::WATER:
			case Block::FLOWING_WATER:
				return 1.5;
			case Block::COBWEB:
				return 2.0;
			default:
				return 1.0;
		}
	}
}
