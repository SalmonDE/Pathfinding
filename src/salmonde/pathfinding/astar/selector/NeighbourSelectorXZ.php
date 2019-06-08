<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar\selector;

use pocketmine\block\Block;
use pocketmine\math\Facing;

class NeighbourSelectorXZ implements NeighbourSelector {

	public function getNeighbours(Block $block): array{
		return [
			Facing::NORTH => $block->getSide(Facing::NORTH),
			Facing::SOUTH => $block->getSide(Facing::SOUTH),
			Facing::WEST  => $block->getSide(Facing::WEST),
			Facing::EAST  => $block->getSide(Facing::EAST)
		];
	}
}
