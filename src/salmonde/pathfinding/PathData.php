<?php
declare(strict_types = 1);

namespace salmonde\pathfinding;

use salmonde\pathfinding\utils\node\Node;
use SplQueue;

class PathData extends SplQueue {

	protected Node $startNode;
	protected Node $targetNode;

	public function __construct(Node $startNode, Node $targetNode){
		$this->startNode = $startNode;
		$this->targetNode = $targetNode;
	}

	public function getStartNode(): Node{
		return $this->startNode;
	}

	public function getTargetNode(): Node{
		return $this->targetNode;
	}

	public function getNextNode(): Node{
		return $this->dequeue();
	}
}
