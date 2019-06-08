<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar\selector;

use pocketmine\block\Block;
use pocketmine\math\Facing;

class NeighbourSelectorZ implements NeighbourSelector {

	public function getNeighbours(Block $block): array{
		return [
			Facing::NORTH => $block->getSide(Facing::NORTH),
			Facing::SOUTH => $block->getSide(Facing::SOUTH)
		];
	}
}
