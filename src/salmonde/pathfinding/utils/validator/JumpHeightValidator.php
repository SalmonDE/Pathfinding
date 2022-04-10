<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use pocketmine\math\Facing;

class JumpHeightValidator extends Validator {

	private int $maxJumpHeight;

	public function __construct(int $priority, int $maxJumpHeight){
		parent::__construct($priority);
		$this->maxJumpHeight = $maxJumpHeight;
	}

	public function isValidBlock(Block $block, array $fromSides): bool{
		if(count($fromSides) !== 1 or $fromSides[0] !== Facing::DOWN){
			return true; // This isn't a jump, hence no jump height limit applies
		}

		$blockPos = $block->getPosition();
		for($i = 1; $i <= $this->maxJumpHeight; $i++){
			if($this->chunkManager->getBlockAt($blockPos->x, $blockPos->y - $i, $blockPos->z)->isSolid()){
				return true;
			}
		}

		return false;
	}
}
