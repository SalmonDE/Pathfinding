<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\heuristic;

use salmonde\pathfinding\utils\node\Node;

class DjikstraHeuristic extends Heuristic {

	public function estimateCost(Node $node1, Node $node2): float{
		return 0.0;
	}
}