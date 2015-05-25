<?php namespace Emilkje\HandleIt;

/**
 * Class HandleIt
 * @package Emilkje\HandleIt
 */
class HandleIt {

	/**
	 * @var HandlerInterface[] $handlers
	 */
	private $handlers = [];

	private $default_handler;
	private $override_default;

	function __construct($default_handler = null) {
		$this->default_handler = $default_handler ? : set_error_handler(function(){});
	}

	/**
	 * @param HandlerInterface $handler
	 *
	 * @return HandleIt $this
	 */
	public function add(HandlerInterface $handler) {
		$this->handlers[ get_class($handler) ] = $handler;
		return $this;
	}

	public function listen($types, $override_default = true) {
		$this->override_default = $override_default;
		set_error_handler($this->makeHandle(), $types ? : E_ALL);
	}

	private function makeHandle() {
		return function($code, $message, $file, $line, $context) {
			foreach($this->handlers as $handler) {
				$handler->handle($this->make($code, $message, $file, $line, $context));
			}

			return $this->override_default;
		};
	}

	public function handle(callable $handler) {
		$this->add(new Handler($handler));
		return $this;
	}

	public function make($code, $message, $file, $line, $context) {
		return new Fault($code, $message, $file, $line, $context);
	}
}