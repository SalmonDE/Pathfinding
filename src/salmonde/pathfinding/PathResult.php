<?php
declare(strict_types = 1);

namespace salmonde\pathfinding;

use pocketmine\math\Vector3;
use pocketmine\level\Level;
use SplQueue;

class PathResult extends SplQueue {

	public function getNextPosition(): Vector3{
		return $this->dequeue();
	}
}
