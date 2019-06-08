<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use salmonde\pathfinding\Algorithm;

abstract class Validator {

	private $priority;

	public function __construct(int $priority){
		$this->priority = $priority;
	}

	public function getPriority(): int{
		return $this->priority;
	}

	abstract public function isValidBlock(Algorithm $algorithm, Block $block, int $fromSide): bool;
}
