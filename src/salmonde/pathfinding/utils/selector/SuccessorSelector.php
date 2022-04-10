<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\selector;

use pocketmine\math\Facing;
use pocketmine\math\Vector3;

abstract class SuccessorSelector {

	public static function toDeltaCoordinates(array $sideComponents, int &$dx, int &$dy, int &$dz): void{
		foreach($sideComponents as $sideComponent){
			switch($sideComponent){
				case Facing::NORTH:
					$dz -= 1;
					break;
				case Facing::SOUTH:
					$dz += 1;
					break;
				case Facing::WEST:
					$dx -= 1;
					break;
				case Facing::EAST:
					$dx += 1;
					break;
				case Facing::DOWN:
					$dy -= 1;
					break;
				case Facing::UP:
					$dy += 1;
					break;
			}
		}
	}

	public function getSuccessors(Vector3 $pos): array{
		$successors = [];
		foreach($this->getSideComponents() as $sideComponentIndex => $sideComponents){
			$dx = $dy = $dz = 0;
			self::toDeltaCoordinates($sideComponents, $dx, $dy, $dz);
			$successors[$sideComponentIndex] = $pos->add($dx, $dy, $dz);
		}

		return $successors;
	}

	abstract public function getSideComponents(): array;
}
