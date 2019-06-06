<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use salmonde\pathfinding\Algorithm;

class DistanceValidator extends Validator {

	private $maxDistanceSquared;

	public function __construct(int $priority, int $maxDistance){
		parent::__construct($priority);
		$this->maxDistanceSquared = $maxDistance ** 2;
	}

	public function isValidBlock(Algorithm $algorithm, Block $block): bool{
		$startPos = $algorithm->getStartPos();
		return ($startPos->x - $block->x) ** 2 + ($startPos->y - $block->y) ** 2 + ($startPos->z - $block->z) ** 2 >= $this->maxDistanceSquared;
	}
}
