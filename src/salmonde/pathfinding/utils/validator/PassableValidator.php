<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use pocketmine\math\AxisAlignedBB;
use salmonde\pathfinding\utils\selector\SuccessorSelector;

class PassableValidator extends Validator {

	protected AxisAlignedBB $boundingBox;

	public function __construct(int $priority, AxisAlignedBB $boundingBox){
		parent::__construct($priority);
		$this->boundingBox = $boundingBox;
	}

	public function isValidBlock(Block $block, array $fromSides): bool{
		if($block->isSolid()){
			return false;
		}

		$blockPos = $block->getPosition();
		$boundingBox = $this->boundingBox->offsetCopy($blockPos->x, $blockPos->y, $blockPos->z);
		if(!$this->checkBoundingBoxCollisions($boundingBox)){
			return false;
		}

		if(count($fromSides) === 2){
			$dx = $dy = $dz = 0;

			SuccessorSelector::toDeltaCoordinates($fromSides, $dx, $dy, $dz);
			$boundingBox->offset(0.5 * -$dx, 0.5 * -$dy, 0.5 * -$dz); // offset to the corner between the previous and the current position to check 'passability'

			return $this->checkBoundingBoxCollisions($boundingBox);
		}

		return true;
	}

	protected function checkBoundingBoxCollisions(AxisAlignedBB $bb): bool{
		$minX = (int) floor($bb->minX - 1);
		$minY = (int) floor($bb->minY - 1);
		$minZ = (int) floor($bb->minZ - 1);
		$maxX = (int) floor($bb->maxX + 1);
		$maxY = (int) floor($bb->maxY + 1);
		$maxZ = (int) floor($bb->maxZ + 1);

		for($z = $minZ; $z <= $maxZ; ++$z){
			for($x = $minX; $x <= $maxX; ++$x){
				for($y = $minY; $y <= $maxY; ++$y){
					$block = $this->chunkManager->getBlockAt($x, $y, $z);
					if($block->isSolid() && $block->collidesWithBB($bb)){
						return false;
					}
				}
			}
		}

		return true;
	}
}
