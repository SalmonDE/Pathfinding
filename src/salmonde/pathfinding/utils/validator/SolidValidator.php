<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use salmonde\pathfinding\utils\node\Node;

class SolidValidator extends Validator {

	public function isValidNode(Node $node, Block $block, array $fromSides): bool{
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
