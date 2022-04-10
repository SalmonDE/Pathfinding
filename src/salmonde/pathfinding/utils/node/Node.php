<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\node;

use pocketmine\math\Vector3;

abstract class Node extends Vector3 {

	public ?Node $predecessor = null;

	public static function fromVector3(Vector3 $pos){
		return new static($pos->x, $pos->y, $pos->z);
	}

	abstract public function getF(): float;
}
