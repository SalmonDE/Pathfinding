<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\heuristic;

use salmonde\pathfinding\utils\node\Node;

abstract class Heuristic {

	abstract public function estimateCost(Node $node1, Node $node2): float;
}