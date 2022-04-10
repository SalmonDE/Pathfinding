<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use pocketmine\block\Block;
use pocketmine\world\World;
use salmonde\pathfinding\PathData;
use salmonde\pathfinding\utils\ChunkManager;
use salmonde\pathfinding\utils\node\Node;

abstract class Validator {

	private int $priority;

	protected World|ChunkManager $chunkManager;
	protected PathData $pathData;

	public bool $allowInvalid = false;

	public function __construct(int $priority){
		$this->priority = $priority;
	}

	public function getPriority(): int{
		return $this->priority;
	}

	public function init(World|ChunkManager $chunkManager, PathData $pathData): void{
		$this->chunkManager = $chunkManager;
		$this->pathData = $pathData;
	}

	abstract public function isValidNode(Node $node, Block $block, array $fromSides): bool;
}
