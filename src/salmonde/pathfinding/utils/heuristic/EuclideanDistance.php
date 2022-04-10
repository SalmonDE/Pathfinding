<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\heuristic;

use salmonde\pathfinding\utils\node\Node;

class EuclideanDistance extends Heuristic {

	public function estimateCost(Node $node1, Node $node2): float{
		return (float) sqrt(($node1->x - $node2->x) ** 2 + ($node1->y - $node2->y) ** 2 + ($node1->z - $node2->z) ** 2);
	}
}