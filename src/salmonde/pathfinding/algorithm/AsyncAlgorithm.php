<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\algorithm;

use pocketmine\math\Vector3;
use salmonde\pathfinding\utils\ChunkManager;

abstract class AsyncAlgorithm extends Algorithm {

	protected ChunkManager $chunkManager;

	public function initPathData(Vector3 $startPos, Vector3 $targetPos): void{
		$this->validatorManager->initValidators($this->chunkManager, $this->pathData);
	}
}