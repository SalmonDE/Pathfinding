<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\astar;

use Ds\Map;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use salmonde\pathfinding\Algorithm;
use salmonde\pathfinding\PathResult;
use function abs;

class AStar extends Algorithm {

	private $openListHeap;
	private $openList;
	private $closedList;

	private $neighbourSelector;

	public function __construct(Level $world, Vector3 $startPos, Vector3 $targetPos){
		parent::__construct($world, Node::fromVector3($startPos), Node::fromVector3($targetPos));
		$this->set3D();
	}

	public function reset(): void{
		$this->openListHeap = new NodeHeap();
		$this->openList = new Map();
		$this->closedList = new Map();

		$startPos = $this->getStartPos();
		$startPos->setG(0.0);
		$startPos->setH($this->calculateEstimatedCost($startPos));
		$this->openList->put(Level::blockHash($startPos->x, $startPos->y, $startPos->z), $startPos);
		$this->openListHeap->insert($startPos);
	}

	public function resetPathResult(): void{
		parent::resetPathResult();
		$this->setTargetPos($this->getTargetPos());
		$this->setStartPos($this->getStartPos());
	}

	public function getNeighbourSelector(): NeighbourSelector{
		return $this->neighbourSelector;
	}

	public function setNeighbourSelector(NeighbourSelector $neighbourSelector): void{
		$this->neighbourSelector = $neighbourSelector;
	}

	public function set3D(): void{
		$this->setNeighbourSelector(new NeighbourSelector3D());
	}

	public function set2D(): void{
		$this->setNeighbourSelector(new NeighbourSelector2D());
	}

	public function setStartPos(Vector3 $startPos): void{
		parent::setStartPos(Node::fromVector3($startPos));
	}

	public function setTargetPos(Vector3 $targetPos): void{
		parent::setTargetPos(Node::fromVector3($targetPos));
	}

	public function calculateEstimatedCost(Vector3 $pos): float{
		$targetPos = $this->getTargetPos();
		return abs($pos->x - $targetPos->x) + abs($pos->y - $targetPos->y) + abs($pos->z - $targetPos->z);
	}

	public function tick(): void{
		var_dump([$this->openList, $this->openListHeap, $this->closedList]);
		$currentNode = $this->openListHeap->extract();

		if($currentNode->equals($this->getTargetPos())){
			$this->reset();
			$this->getTargetPos()->setPredecessor($currentNode);
			$this->parsePath();
			return;
		}

		$hash = Level::blockHash($currentNode->x, $currentNode->y, $currentNode->z);
		$this->openList->remove($hash);
		$this->closedList->put($hash, $currentNode);

		$block = $this->getWorld()->getBlockAt($currentNode->x, $currentNode->y, $currentNode->z);

		foreach($this->getNeighbourSelector()->getNeighbours($block) as $neighbourBlock){
			$neighbourHash = Level::blockHash($neighbourBlock->x, $neighbourBlock->y, $neighbourBlock->z);

			if($this->closedList->hasKey($neighbourHash) or !$this->isValidBlock($neighbourBlock)){
				continue;
			}

			$inOpenList = $this->openList->hasKey($neighbourHash);
			$neighbourNode = $inOpenList ? $this->openList->get($neighbourHash) : Node::fromVector3($neighbourBlock);

			$cost = CostCalculator::getCost($neighbourBlock);
			if(!$inOpenList or $currentNode->getG() + $cost < $neighbourNode->getG()){
				$neighbourNode->setG($currentNode->getG() + $cost);
				$neighbourNode->setH($this->calculateEstimatedCost($neighbourBlock));
				$neighbourNode->setPredecessor($currentNode);

				if(!$inOpenList){
					$this->openList->put($neighbourHash, $neighbourNode);
					$this->openListHeap->insert($neighbourNode);
				}
			}
		}
	}

	public function isFinished(): bool{
		return $this->getPathResult() instanceof PathResult or $this->openListHeap->isEmpty();
	}

	protected function parsePath(): void{
		$pathResult = new PathResult();
		$currentNode = $this->getTargetPos();

		do{
			$currentNode = $currentNode->getPredecessor();
			if($currentNode instanceof Node){
				$pathResult->unshift($currentNode);
			}else{
				break;
			}
		}while(true);

		$this->pathResult = $pathResult;
	}
}