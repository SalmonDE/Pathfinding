<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use salmonde\pathfinding\Algorithm;

class InsideWorldValidator extends Validator {

	public function isValidBlock(Algorithm $algorithm, Block $block, int $fromSide): bool{
		$blockPos = $block->getPos();
		return $algorithm->getWorld()->isInWorld($blockPos->x, $blockPos->y, $blockPos->z);
	}
}
