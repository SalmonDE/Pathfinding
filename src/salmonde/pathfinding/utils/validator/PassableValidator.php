<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use pocketmine\block\Solid;
use pocketmine\math\AxisAlignedBB;
use salmonde\pathfinding\Algorithm;

class PassableValidator extends Validator {

	private $boundingBox;

	public function __construct(int $priority, AxisAlignedBB $boundingBox){
		parent::__construct($priority);
		$this->boundingBox = $boundingBox;
	}

	public function isValidBlock(Algorithm $algorithm, Block $block): bool{
		return !($block instanceof Solid);
	}
}
