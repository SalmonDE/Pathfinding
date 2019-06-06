<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar;

use pocketmine\math\Vector3;
use const PHP_INT_MAX;

class Node extends Vector3 {

	private $g = PHP_INT_MAX;
	private $h = PHP_INT_MAX;

	private $successor;
	private $predecessor;

	public static function fromVector3(Vector3 $pos){
		return new self($pos->x, $pos->y, $pos->z);
	}

	public function getF(): float{
		return $this->g + $this->h;
	}

	public function getG(): float{
		return $this->g;
	}

	public function setG(float $g): void{
		$this->g = $g;
	}

	public function getH(): float{
		return $this->h;
	}

	public function setH(float $h): void{
		$this->h = $h;
	}

	public function getPredecessor(): ?Node{
		return $this->predecessor;
	}

	public function setPredecessor(Node $node): void{
		$this->predecessor = $node;
	}
}
