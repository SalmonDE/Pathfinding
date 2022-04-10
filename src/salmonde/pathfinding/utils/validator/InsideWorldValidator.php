<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;

class InsideWorldValidator extends Validator {

	public function isValidBlock(Block $block, array $fromSides): bool{
		$blockPos = $block->getPosition();
		return $this->chunkManager->isInWorld($blockPos->x, $blockPos->y, $blockPos->z);
	}
}
