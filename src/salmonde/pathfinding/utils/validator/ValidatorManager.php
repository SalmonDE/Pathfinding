<?php
declare(strict_types = 1);

namespace salmonde\pathfinding\utils\validator;

use Generator;
use pocketmine\world\World;
use salmonde\pathfinding\PathData;
use salmonde\pathfinding\utils\ChunkManager;

class ValidatorManager {

	private array $validators = [];

	public function initValidators(World|ChunkManager $chunkManager, PathData $pathData): void{
		foreach($this->yieldValidators() as $validator){
			$validator->init($chunkManager, $pathData);
		}
	}

	public function addValidator(Validator $validator): void{
		$this->validators[] = $validator;
		$this->sortValidators();
	}

	public function removeValidator(Validator $validator): void{
		$index = array_search($validator, $this->validators);

		if($index !== false){
			unset($this->validators[$index]);
			$this->sortValidators();
		}
	}

	protected function sortValidators(): void{
		usort($this->validators, function(Validator $v1, Validator $v2): int{
			return $v2->getPriority() - $v1->getPriority();
		});
	}

	public function getValidators(): array{
		return $this->validators;
	}

	public function yieldValidators(): Generator{
		foreach($this->validators as $validator){
			yield $validator;
		}
	}

	protected function getValidatorPriorities(): array{
		$priorities = [];
		foreach($this->getValidators() as $validator){
			$priorities[] = $validator->getPriority();
		}

		return $priorities;
	}

	public function getHighestValidatorPriority(): int{
		if(count($this->getValidators()) === 0){
			return 0;
		}

		return max($this->getValidatorPriorities());
	}

	public function getLowestValidatorPriority(): int{
		if(count($this->getValidators()) === 0){
			return 0;
		}

		return min($this->getValidatorPriorities());
	}
}