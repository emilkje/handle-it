<?php namespace Emilkje\HandleIt;

/**
 * Class Handler
 * @package Emilkje\HandleIt
 */
class Handler implements HandlerInterface {

	/**
	 * @var callable $callback
	 */
	private $callback;

	/**
	 * @param callable $callback
	 */
	public function __construct(callable $callback = null) {
		$this->callback = $callback;
	}

	/**
	 * @return string
	 */
	function __toString() {
		return get_class($this);
	}

	/**
	 * @param FaultInterface $fault
	 *
	 * @return mixed
	 */
	public function handle(FaultInterface $fault) {
			call_user_func_array($this->callback, [$fault]);
	}


}