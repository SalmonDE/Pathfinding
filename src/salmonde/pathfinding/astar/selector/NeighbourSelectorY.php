<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar\selector;

use pocketmine\block\Block;
use pocketmine\math\Facing;

class NeighbourSelectorY implements NeighbourSelector {

	public function getNeighbours(Block $block): array{
		return [
			Facing::UP   => $block->getSide(Facing::UP),
			Facing::DOWN => $block->getSide(Facing::DOWN)
		];
	}
}
