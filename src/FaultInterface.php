<?php namespace Emilkje\HandleIt;

/**
 * Interface Faultinterface
 * @package Emilkje\HandleIt
 */
interface Faultinterface {

	public function code();
	public function message();
	public function file();
	public function line();
	public function context();
}