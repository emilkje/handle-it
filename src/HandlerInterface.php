<?php namespace Emilkje\HandleIt;

/**
 * Interface HandlerInterface
 * @package Emilkje\HandleIt
 */
interface HandlerInterface {

	/**
	 * @param FaultInterface $fault
	 *
	 * @return mixed
	 */
	public function handle(FaultInterface $fault);
}