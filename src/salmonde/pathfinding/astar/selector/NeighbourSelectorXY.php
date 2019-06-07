<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar\selector;

use pocketmine\block\Block;
use pocketmine\math\Facing;

class NeighbourSelectorXY implements NeighbourSelector {

	public function getNeighbours(Block $block): array{
		return [
			$block->getSide(Facing::UP),
			$block->getSide(Facing::DOWN),
			$block->getSide(Facing::WEST),
			$block->getSide(Facing::EAST)
		];
	}
}
