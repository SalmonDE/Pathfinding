<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use salmonde\pathfinding\utils\node\Node;

class InsideWorldValidator extends Validator {

	public function isValidNode(Node $node, Block $block, array $fromSides): bool{
		return $this->chunkManager->isInWorld($node->x, $node->y, $node->z);
	}
}
