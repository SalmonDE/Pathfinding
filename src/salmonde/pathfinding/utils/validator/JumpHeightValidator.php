<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use pocketmine\math\Facing;
use salmonde\pathfinding\Algorithm;

class JumpHeightValidator extends Validator {

	private $maxJumpHeight;

	public function __construct(int $priority, int $maxJumpHeight){
		parent::__construct($priority);
		$this->maxJumpHeight = $maxJumpHeight;
	}

	public function isValidBlock(Algorithm $algorithm, Block $block, int $fromSide): bool{
		if($fromSide !== Facing::DOWN){
			return true; // This isn't a jump, hence no jump height limit applies
		}

		for($i = 1; $i <= $this->maxJumpHeight; $i++){
			if($block->getSide(Facing::DOWN, $i)->isSolid()){
				return true;
			}
		}

		return false;
	}
}
