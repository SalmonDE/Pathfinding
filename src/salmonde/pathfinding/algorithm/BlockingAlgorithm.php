<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\algorithm;

use pocketmine\math\Vector3;

abstract class BlockingAlgorithm extends Algorithm {

	protected int $iterations = 0;
	public int $maxIterations = 0;

	protected float $startTime;
	public float $timeout = 0.0;

	protected function checkTime(): bool{
		return $this->timeout === 0.0 || microtime(true) - $this->startTime < $this->timeout;
	}

	protected function checkIterations(): bool{
		return $this->maxIterations === 0 || $this->iterations < $this->maxIterations;
	}

	public function findPath(): void{
		$this->startTime = microtime(true);

		while(!$this->isFinished() && $this->checkTime() && $this->checkIterations()){
			$this->tick();
		}
	}

	public function initPathData(Vector3 $startPos, Vector3 $targetPos): void{
		$this->validatorManager->initValidators($this->world, $this->pathData);
	}
}