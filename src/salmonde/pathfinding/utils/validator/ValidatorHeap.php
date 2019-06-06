<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use SplMaxHeap;

class ValidatorHeap extends SplMaxHeap {

	protected function compare($v1, $v2): int{
		return $v1->getPriority() - $v2->getPriority();
	}
}
