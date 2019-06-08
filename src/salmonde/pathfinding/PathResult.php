<?php
declare(strict_types = 1);

namespace salmonde\pathfinding;

use SplQueue;

class PathResult extends SplQueue {

	public function getNextPosition(): Vector3{
		return $this->dequeue();
	}
}
