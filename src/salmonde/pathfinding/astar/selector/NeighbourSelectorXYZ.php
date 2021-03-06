<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar\selector;

use pocketmine\block\Block;
use pocketmine\math\Vector3;

class NeighbourSelectorXYZ implements NeighbourSelector {

	public function getNeighbours(Block $block): array{
		return [
			Vector3::SIDE_UP    => $block->getSide(Vector3::SIDE_UP),
			Vector3::SIDE_DOWN  => $block->getSide(Vector3::SIDE_DOWN),
			Vector3::SIDE_NORTH => $block->getSide(Vector3::SIDE_NORTH),
			Vector3::SIDE_SOUTH => $block->getSide(Vector3::SIDE_SOUTH),
			Vector3::SIDE_WEST  => $block->getSide(Vector3::SIDE_WEST),
			Vector3::SIDE_EAST  => $block->getSide(Vector3::SIDE_EAST)
		];
	}
}
