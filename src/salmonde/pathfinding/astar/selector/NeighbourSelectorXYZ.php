<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar\selector;

use pocketmine\block\Block;

class NeighbourSelectorXYZ implements NeighbourSelector {

	public function getNeighbours(Block $block): array{
		return [
			Facing::UP    => $block->getSide(Facing::UP),
			Facing::DOWN  => $block->getSide(Facing::DOWN),
			Facing::NORTH => $block->getSide(Facing::NORTH),
			Facing::SOUTH => $block->getSide(Facing::SOUTH),
			Facing::WEST  => $block->getSide(Facing::WEST),
			Facing::EAST  => $block->getSide(Facing::EAST)
		];
	}
}
