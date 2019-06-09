<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use pocketmine\math\Vector3;
use salmonde\pathfinding\Algorithm;

class JumpHeightValidator extends Validator {

	private $maxJumpHeight;

	public function __construct(int $priority, int $maxJumpHeight){
		parent::__construct($priority);
		$this->maxJumpHeight = $maxJumpHeight;
	}

	public function isValidBlock(Algorithm $algorithm, Block $block, int $fromSide): bool{
		if($fromSide !== Vector3::SIDE_DOWN){
			return true; // This isn't a jump, hence no jump height limit applies
		}

		$maxDepth = $this->maxJumpHeight + 1;
		for($i = 1; $i <= $maxDepth; $i++){
			if($block->getSide(Vector3::SIDE_DOWN, $i)->isSolid()){
				return true;
			}
		}

		return false;
	}
}
