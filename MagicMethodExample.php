<?php

class MagicMethodClass {
	public function __construct()
	{
		echo "This is the function that is called automatically called when a class is instantiated.".PHP_EOL;
	}

	public function __toString()
	{
		// RETURN stuff from this function, it expects a string.
		return "This is the function that is called when you try to use print or echo or a variable that holds an instance of this class.";
	}

	public function __invoke($args)
	{
		echo "This is printed out when you call this class like a function.".PHP_EOL;
		echo "These arguments were passed to invoke: ".implode(", ", func_get_args());
	}

	public function __destruct()
	{
		echo "Getting rid of the instance of this class";
	}
}

// Get an instance of the class.
$mmClass = new MagicMethodClass;

// Show that it's an object.
echo "mmClass has a PHP type of : ".gettype($mmClass).PHP_EOL;

// Print it out, this will call __toString automatically.
echo $mmClass.PHP_EOL;

// Call it as a function with a load of arguments!
$mmClass(1887, "Dan", 'hello', array());
echo PHP_EOL;


