<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\heuristic;

use salmonde\pathfinding\utils\node\Node;

class OctileDistance extends Heuristic {

	protected const D = 1;
	protected const D2 = M_SQRT2;

	public function estimateCost(Node $node1, Node $node2): float{
		$dx = abs($node1->x - $node2->x);
		$dy = abs($node1->y - $node2->y);
		$dz = abs($node1->z - $node2->z);

		return (float) (self::D * ($dx + $dy + $dz) + (self::D2 - 2 * self::D) * min($dx, $dy, $dz));
	}
}