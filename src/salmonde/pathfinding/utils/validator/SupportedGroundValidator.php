<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use pocketmine\math\Facing;
use salmonde\pathfinding\utils\node\Node;
use salmonde\pathfinding\utils\selector\SuccessorSelector;

class SupportedGroundValidator extends Validator {

	protected int $maxJumpHeight;
	protected int $maxDropHeight;

	public function __construct(int $priority, int $maxJumpHeight, int $maxDropHeight){
		parent::__construct($priority);
		$this->maxJumpHeight = max(0, $maxJumpHeight);
		$this->maxDropHeight = max(0, $maxDropHeight);
	}

	public function isValidNode(Node $node, Block $block, array $fromSides): bool{
		if(in_array(Facing::DOWN, $fromSides)){
			return $this->isValidJump($node, $block, $fromSides);
		}elseif(in_array(Facing::UP, $fromSides)){
			return $this->isValidDrop($node, $block, $fromSides);
		}

		// check if the block beneath the current node is solid
		return $this->chunkManager->getBlockAt($node->x, $node->y - 1, $node->z)->isSolid();
	}

	protected function isValidJump(Node $node, Block $block, array $fromSides): bool{
		if($this->maxJumpHeight === 0){
			return false;
		}

		$previousNode = $node->predecessor;
		if($previousNode === null){
			return false;
		}

		for($i = 1; $i <= $this->maxJumpHeight; $i++){ // $i ≙ dy
			if($this->chunkManager->getBlockAt($previousNode->x, $previousNode->y - 1, $previousNode->z)->isSolid()){
				return true;
			}

			if($previousNode->predecessor === null || ($previousNode->y - $previousNode->predecessor->y !== 1)){
				break;
			}
		}

		return false;
	}

	protected function isValidDrop(Node $node, Block $block, array $fromSides): bool{
		for($i = 1; $i <= $this->maxDropHeight; $i++){
			if($this->chunkManager->getBlockAt($node->x, $node->y - $i, $node->z)->isSolid()){
				return true;
			}
		}

		return false;
	}
}
