<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar\selector;

use pocketmine\block\Block;
use pocketmine\math\Facing;

class NeighbourSelectorX implements NeighbourSelector {

	public function getNeighbours(Block $block): array{
		return [
			Facing::WEST => $block->getSide(Facing::WEST),
			Facing::EAST => $block->getSide(Facing::EAST)
		];
	}
}
