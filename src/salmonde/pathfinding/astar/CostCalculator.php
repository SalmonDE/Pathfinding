<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar;

use pocketmine\block\Block;

class CostCalculator {

	static public function getCost(Block $block): float{
		return 1.0;
	}
}
