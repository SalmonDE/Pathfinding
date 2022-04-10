<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use salmonde\pathfinding\utils\node\Node;

class DistanceValidator extends Validator {

	protected int $maxDistanceSquared;

	public function __construct(int $priority, int $maxDistance){
		parent::__construct($priority);
		$this->maxDistanceSquared = $maxDistance ** 2;
	}

	public function isValidNode(Node $node, Block $block, array $fromSides): bool{
		return $this->pathData->getStartNode()->distanceSquared($node) <= $this->maxDistanceSquared;
	}
}
