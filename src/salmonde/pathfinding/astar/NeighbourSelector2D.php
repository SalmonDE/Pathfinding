<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar;

use pocketmine\block\Block;

class NeighbourSelector2D implements NeighbourSelector {

	public function getNeighbours(Block $block): array{
		return $block->getHorizontalSides();
	}
}
