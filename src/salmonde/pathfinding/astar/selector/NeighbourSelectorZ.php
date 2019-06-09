<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar\selector;

use pocketmine\block\Block;
use pocketmine\math\Vector3;

class NeighbourSelectorZ implements NeighbourSelector {

	public function getNeighbours(Block $block): array{
		return [
			Vector3::SIDE_NORTH => $block->getSide(Vector3::SIDE_NORTH),
			Vector3::SIDE_SOUTH => $block->getSide(Vector3::SIDE_SOUTH)
		];
	}
}
