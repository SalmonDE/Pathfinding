<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\cost;

use pocketmine\block\Block;

abstract class CostCalculator {

	abstract public function getCost(Block $block, array $fromSides): float;

	abstract public function getInvalidCost(Block $block, array $fromSides): float;
}
