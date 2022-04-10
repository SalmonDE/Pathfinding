<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\algorithm\astar;

use salmonde\pathfinding\utils\node\Node;

class AStarNode extends Node {

	public float $g = INF;
	public float $h = INF;

	public function getF(): float{
		return $this->g + $this->h;
	}
}
