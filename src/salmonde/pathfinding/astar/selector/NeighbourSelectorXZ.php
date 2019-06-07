<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar\selector;

use pocketmine\block\Block;

class NeighbourSelectorXZ implements NeighbourSelector {

	public function getNeighbours(Block $block): array{
		return $block->getHorizontalSides();
	}
}
