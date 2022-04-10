<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\cost;

use pocketmine\block\Block;
use pocketmine\block\BlockLegacyIds as Ids;

class DefaultCostCalculator extends CostCalculator {

	public function getCost(Block $block, array $fromSides): float{
		return match($block->getId()){
			Ids::WATER, Ids::FLOWING_WATER => 2.0,
			Ids::COBWEB => 3.0,
			default => 1.0,
		} + (count($fromSides) === 2 ? M_SQRT2 - 1.0 : 0.0);
	}

	public function getInvalidCost(Block $block, array $fromSides): float{
		return 1000.0;
	}
}
