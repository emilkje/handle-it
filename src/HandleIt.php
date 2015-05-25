<?php namespace Emilkje\HandleIt;

class HandleIt {
	
	private $handlers = [];

	public function add(HandlerInterface $handler) {
		$this->handlers[$handler] = $handler;
	}
}