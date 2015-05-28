<?php namespace Emilkje\HandleIt;

/**
 * Interface Faultinterface
 * @package Emilkje\HandleIt
 */
interface FaultInterface {

	public function code();
	public function message();
	public function file();
	public function line();
	public function context();
}