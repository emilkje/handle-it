<?php namespace Emilkje\HandleIt;

class Fault implements Faultinterface {

	private $code;
	private $message;
	private $file;
	private $line;
	private $context;

	function __construct($code, $message, $file, $line, $context) {
		$this->code = $code;
		$this->message = $message;
		$this->file = $file;
		$this->line = $line;
		$this->context = $context;
	}

	public function code() {
		return $this->code;
	}

	public function message() {
		return $this->message;
	}

	public function file() {
		return $this->file;
	}

	public function line() {
		return $this->line;
	}

	public function context() {
		return $this->context;
	}


}