# handle-it
Handle all the things with a unified interface

# Usage

```php
<?php
require_once "vendor/autoload.php";
use Emilkje\HandleIt\HandleIt;
use Emilkje\HandleIt\Handler;
use Emilkje\HandleIt\HandlerInterface;
use Emilkje\HandleIt\FaultInterface;

$handleit = new HandleIt;

// File logging handler
$logging_handler = new Handler(function(FaultInterface $fault){
	echo "Log to file\n";
});

// Another handler overriding the file logging handler
$overriding_handler = new Handler(function(FaultInterface $fault){
	echo "Log to cloud (overrides file handler)\n";
});

// A second log handler
class TestLogger extends Handler {
	function handle(Faultinterface $fault) {
		echo "this is an additional handler that runs as well ";
		echo $fault->code() . " == "."\n";
	}
}

// A Slack integration handler that implements the HandlerInterface
class SlackHandler implements HandlerInterface {
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
```
