<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use salmonde\pathfinding\Algorithm;

class InsideWorldValidator extends Validator {

	public function isValidBlock(Algorithm $algorithm, Block $block, int $fromSide): bool{
		return $algorithm->getWorld()->isInWorld($block->x, $block->y, $block->z);
	}
}
