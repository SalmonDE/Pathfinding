<?php
declare(strict_types = 1);

namespace salmonde\pathfinding;

use pocketmine\level\Level;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Vector3;
use salmonde\pathfinding\astar\AStar;
use salmonde\pathfinding\utils\validator\DistanceValidator;
use salmonde\pathfinding\utils\validator\InsideWorldValidator;
use salmonde\pathfinding\utils\validator\JumpHeightValidator;
use salmonde\pathfinding\utils\validator\PassableValidator;

class Pathfinder {

	private $algorithm;

	private $iterations = 0;
	private $maxIterations;

	private $startTime;
	private $timeout;

	public function __construct(Level $world, Vector3 $startPos, Vector3 $targetPos, ?AxisAlignedBB $boundingBox = null, float $timeout = 1.0, int $maxIterations = 100000){
		$this->algorithm = new AStar($world, $startPos, $targetPos);
		$this->timeout = $timeout;
		$this->maxIterations = $maxIterations;

		$this->addDefaultValidators($boundingBox);
	}

	protected function addDefaultValidators(?AxisAlignedBB $boundingBox = null): void{
		$highestPriority = $this->getAlgorithm()->getHighestValidatorPriority();
		$this->algorithm->addValidator(new InsideWorldValidator($highestPriority === 0 ? 100 : $highestPriority + 1));
		$this->algorithm->addValidator(new PassableValidator($this->getAlgorithm()->getLowestValidatorPriority() - 1, $boundingBox ?? new AxisAlignedBB(0, 0, 0, 1, 1, 1)));
	}

	public function getAlgorithm(): Algorithm{
		return $this->algorithm;
	}

	public function findPath(): void{
		$this->startTime = microtime(true);
		$algorithm = $this->getAlgorithm();

		while(!$algorithm->isFinished() and $this->checkTime() and $this->checkIterations()){
			$algorithm->tick();
		}
	}

	protected function checkTime(): bool{
		return $this->timeout === 0.0 or microtime(true) - $this->startTime < $this->timeout;
	}

	protected function checkIterations(): bool{
		return $this->maxIterations === 0 or $this->iterations < $this->maxIterations;
	}

	public function getPathResult(): ?PathResult{
		return $this->getAlgorithm()->getPathResult();
	}

	public function setMaxDistance(int $maxDistance): void{
		$this->algorithm->addValidator(new DistanceValidator($this->getAlgorithm()->getLowestValidatorPriority() - 1, $maxDistance));
	}

	public function setMaxJumpHeight(int $maxJumpHeight): void{
		$this->algorithm->addValidator(new JumpHeightValidator($this->getAlgorithm()->getLowestValidatorPriority() - 1, $maxJumpHeight));
	}
}
