<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\heuristic;

use function abs;
use salmonde\pathfinding\utils\node\Node;

class ManhattanDistance extends Heuristic {

	public function estimateCost(Node $node1, Node $node2): float{
		return (float) (abs($node1->x - $node2->x) + abs($node1->y - $node2->y) + abs($node1->z - $node2->z));
	}
}