<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\selector\diagonal;

use pocketmine\math\Facing;
use salmonde\pathfinding\utils\selector\SuccessorSelector;

class SuccessorSelectorXYZD extends SuccessorSelector {

	public function getSideComponents(): array{
		return [
			[Facing::UP],
			[Facing::DOWN],
			[Facing::NORTH],
			[Facing::SOUTH],
			[Facing::WEST],
			[Facing::EAST],
			[Facing::NORTH, Facing::WEST],
			[Facing::NORTH, Facing::EAST],
			[Facing::SOUTH, Facing::WEST],
			[Facing::SOUTH, Facing::EAST]
		];
	}
}