<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\selector;

use pocketmine\math\Facing;

class SuccessorSelectorXYZ extends SuccessorSelector {

	public function getSideComponents(): array{
		return [
			[Facing::UP],
			[Facing::DOWN],
			[Facing::NORTH],
			[Facing::SOUTH],
			[Facing::WEST],
			[Facing::EAST]
		];
	}
}
