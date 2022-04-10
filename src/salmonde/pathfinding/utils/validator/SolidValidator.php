<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;

class SolidValidator extends Validator {

	public function isValidBlock(Block $block, array $fromSides): bool{
		if(count($fromSides) === 2){
			foreach($fromSides as $side){
				$pos = $block->getPosition()->getSide($side);
				if($this->chunkManager->getBlockAt($pos->x, $pos->y, $pos->z)->isSolid()){
					return false;
				}
			}
		}

		return !$block->isSolid();
	}
}
