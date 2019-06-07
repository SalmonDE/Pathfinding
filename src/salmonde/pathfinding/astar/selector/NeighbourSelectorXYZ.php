<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar\selector;

use pocketmine\block\Block;

class NeighbourSelectorXYZ implements NeighbourSelector {

	public function getNeighbours(Block $block): array{
		return $block->getAllSides();
	}
}
