<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\algorithm;

use pocketmine\math\Vector3;
use pocketmine\world\World;
use salmonde\pathfinding\PathData;
use salmonde\pathfinding\utils\node\Node;
use salmonde\pathfinding\utils\validator\ValidatorManager;

abstract class Algorithm {

	protected World $world;
	protected ValidatorManager $validatorManager;

	protected PathData $pathData;

	public function __construct(World $world, Vector3 $startPos, Vector3 $targetPos){
		$this->validatorManager = new ValidatorManager();
		$this->setWorld($world);
		$this->initPathData($startPos, $targetPos);
	}

	public function getWorld(): World{
		return $this->world;
	}

	public function setWorld(World $world): void{
		$this->reset();
		$this->world = $world;
	}

	public function getValidatorManager(): ValidatorManager{
		return $this->validatorManager;
	}

	public function getPathData(): PathData{
		return $this->pathData;
	}

	public function hasFoundPath(): bool{
		return $this->pathData->getTargetNode()->predecessor instanceof Node;
	}

	abstract public function initPathData(Vector3 $startPos, Vector3 $targetPos): void;

	abstract public function reset(): void;

	abstract public function tick(): void;

	abstract public function isFinished(): bool;
}
