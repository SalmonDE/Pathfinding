<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar;

use SplMinHeap;

class NodeHeap extends SplMinHeap {

	protected function compare($node1, $node2): int{
		return (int) ($node2->getF() - $node1->getF());
	}
}
