<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils;

use pocketmine\block\Block;
use pocketmine\world\ChunkManager as PMChunkManager;
use pocketmine\world\format\Chunk;
use Threaded;

class ChunkManager extends Threaded implements PMChunkManager {

	protected array $chunks = [];

	public function getBlockAt(int $x, int $y, int $z): Block{
		// TODO: Implement getBlockAt() method.
	}

	public function setBlockAt(int $x, int $y, int $z, Block $block): void{
		// TODO: Implement setBlockAt() method.
	}

	public function getChunk(int $chunkX, int $chunkZ): ?Chunk{
		// TODO: Implement getChunk() method.
	}

	public function setChunk(int $chunkX, int $chunkZ, Chunk $chunk): void{
		// TODO: Implement setChunk() method.
	}

	public function getMinY(): int{
		// TODO: Implement getMinY() method.
	}

	public function getMaxY(): int{
		// TODO: Implement getMaxY() method.
	}

	public function isInWorld(int $x, int $y, int $z): bool{
		// TODO: Implement isInWorld() method.
	}
}