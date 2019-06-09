<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use pocketmine\math\Vector3;
use salmonde\pathfinding\Algorithm;

class SupportedPositionValidator extends Validator {

	public function isValidBlock(Algorithm $algorithm, Block $block, int $fromSide): bool{
		if($fromSide === Vector3::SIDE_DOWN or $fromSide === Vector3::SIDE_UP){
			return true; // Unclear intentions, default to true
		}

		$down = $block->getSide(Vector3::SIDE_DOWN);
		return $down->isSolid() or $down->getSide(Vector3::SIDE_DOWN)->isSolid();
	}
}
