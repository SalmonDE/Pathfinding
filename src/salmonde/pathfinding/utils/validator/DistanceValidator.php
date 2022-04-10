<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;

class DistanceValidator extends Validator {

	protected int $maxDistanceSquared;

	public function __construct(int $priority, int $maxDistance){
		parent::__construct($priority);
		$this->maxDistanceSquared = $maxDistance ** 2;
	}

	public function isValidBlock(Block $block, array $fromSides): bool{
		return $this->pathData->getStartNode()->distanceSquared($block->getPosition()) <= $this->maxDistanceSquared;
	}
}
