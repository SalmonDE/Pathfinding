<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\algorithm\astar;

use pocketmine\math\Facing;
use pocketmine\world\World;
use pocketmine\math\Vector3;
use salmonde\pathfinding\algorithm\BlockingAlgorithm;
use salmonde\pathfinding\exception\PathfindingException;
use salmonde\pathfinding\PathData;
use salmonde\pathfinding\utils\cost\CostCalculator;
use salmonde\pathfinding\utils\heuristic\Heuristic;
use salmonde\pathfinding\utils\node\NodeHeap;
use salmonde\pathfinding\utils\selector\SuccessorSelector;

class AStar extends BlockingAlgorithm {

	protected NodeHeap $openListHeap;
	protected array $openList;
	protected array $closedList;

	protected SuccessorSelector $successorSelector;
	protected CostCalculator $costCalculator;
	protected Heuristic $heuristic;

	public function __construct(SuccessorSelector $successorSelector, CostCalculator $costCalculator, Heuristic $heuristic, World $world, Vector3 $startPos, Vector3 $targetPos){
		$this->successorSelector = $successorSelector;
		$this->costCalculator = $costCalculator;
		$this->heuristic = $heuristic;
		parent::__construct($world, $startPos, $targetPos);
	}

	public function reset(): void{
		$this->openListHeap = new NodeHeap();
		$this->openList = [];
		$this->closedList = [];
	}

	public function getSuccessorSelector(): SuccessorSelector{
		return $this->successorSelector;
	}

	public function getCostCalculator(): CostCalculator{
		return $this->costCalculator;
	}

	public function getHeuristic(): Heuristic{
		return $this->heuristic;
	}

	public function tick(): void{
		$currentNode = $this->openListHeap->extract();

		if($currentNode->equals($this->pathData->getTargetNode())){
			$this->pathData->getTargetNode()->predecessor = $currentNode->predecessor ?? $currentNode;
			$this->pathData->getTargetNode()->g = $currentNode->g;
			$this->parsePath();
			$this->reset();
			return;
		}

		$hash = World::blockHash($currentNode->x, $currentNode->y, $currentNode->z);
		unset($this->openList[$hash]);
		$this->closedList[$hash] = $currentNode;

		$world = $this->getWorld();
		$block = $world->getBlockAt($currentNode->x, $currentNode->y, $currentNode->z);

		foreach($this->successorSelector->getSuccessors($block->getPosition()) as $sideComponentsIndex => $successorBlockPos){
			if(isset($this->closedList[$successorHash = World::blockHash($successorBlockPos->x, $successorBlockPos->y, $successorBlockPos->z)])){
				continue;
			}

			$successorBlock = $world->getBlockAt($successorBlockPos->x, $successorBlockPos->y, $successorBlockPos->z);

			$fromSides = [];
			foreach($this->successorSelector->getSideComponents()[$sideComponentsIndex] as $side){
				$fromSides[] = Facing::opposite($side);
			}
			unset($sideComponentsIndex, $side);

			foreach($this->validatorManager->yieldValidators() as $validator){
				if(!$validator->isValidBlock($block, $fromSides)){
					if($validator->allowInvalid){
						$cost = $this->costCalculator->getInvalidCost($block, $fromSides);
					}else{
						continue 2;
					}
				}
			}

			$successorNode = $this->openList[$successorHash] ?? AStarNode::fromVector3($successorBlockPos);
			$cost = $cost ?? $this->costCalculator->getCost($successorBlock, $fromSides);

			if($currentNode->g + $cost < $successorNode->g){
				$successorNode->g = $currentNode->g + $cost;
				$successorNode->h = $this->heuristic->estimateCost($successorNode, $this->pathData->getTargetNode());
				$successorNode->predecessor = $currentNode;

				if(!isset($this->openList[$successorHash])){
					$this->openList[$successorHash] = $successorNode;
					$this->openListHeap->insert($successorNode);
				}
			}
		}
	}

	public function isFinished(): bool{
		return $this->pathData->getTargetNode()->predecessor instanceof AStarNode or $this->openListHeap->isEmpty();
	}

	protected function parsePath(): void{
		$currentNode = $this->pathData->getTargetNode();

		if($currentNode->predecessor === null){
			throw new PathfindingException("Tried to parse non-existent path");
		}

		do{
			if($currentNode instanceof AStarNode){
				$this->pathData->unshift($currentNode);
			}else{
				break;
			}
			$currentNode = $currentNode->predecessor;
		}while(true);
	}

	public function initPathData(Vector3 $startPos, Vector3 $targetPos): void{
		$this->pathData = new PathData(AStarNode::fromVector3($startPos), AStarNode::fromVector3($targetPos));
		$this->reset();

		$startNode = $this->pathData->getStartNode();
		$startNode->g = $this->pathData->getTargetNode()->h = 0.0;
		$startNode->h = $this->heuristic->estimateCost($startNode, $this->pathData->getTargetNode());
		$this->openList[World::blockHash($startNode->x, $startNode->y, $startNode->z)] = $startNode;
		$this->openListHeap->insert($startNode);

		parent::initPathData($startPos, $targetPos);
	}
}
