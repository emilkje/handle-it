<?php

require_once "vendor/autoload.php";

use Emilkje\HandleIt\HandleIt;
use Emilkje\HandleIt\Handler;
use Emilkje\HandleIt\HandlerInterface;
use Emilkje\HandleIt\Faultinterface;

$handleit = new HandleIt;

$logging_handler = new Handler(function(Faultinterface $fault){
	echo "Log to file\n";
});

$overriding_handler = new Handler(function(Faultinterface $fault){
	echo "Log to cloud (overrides file handler)\n";
});

class TestLogger extends Handler {
	function handle(Faultinterface $fault) {
		echo "this is an additional handler that runs as well ";
		echo $fault->code() . " == "."\n";
	}
}

class SlackHandler extends Handler {
	function handle(Faultinterface $fault) {
		echo "prints \"" . $fault->message() . "\" to the slack chat \n";
	}
}

$handleit
	->add($logging_handler)
	->add($overriding_handler)
	->add(new TestLogger())
	->add(new SlackHandler())
	->listen(E_ALL, true);

trigger_error("The actual error", E_USER_NOTICE);