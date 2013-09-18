<?php

class SimpleClass {
	// A property of the class.
	public $property;

	// Constructor is called when you grab a new copy of the class.
	public function __construct($property_argument)
	{
		$this->property = $property_argument;
	}

	public function classMethod($argument_one, $argument_two)
	{
		echo $argument_one . " - " . $argument_two . " - " . $this->property.PHP_EOL;
	}

}

// Using the class.

$myClass = new SimpleClass("Dan Jesse Smells bad today.");

// Access properties of the class:
echo $myClass->property; // Should print "Dan Jesse Smells bad today"

// Call methods that belong to the class.
$myClass->classMethod("I think ", "that ");
