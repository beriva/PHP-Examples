<?php

function myCounter() {
	static $count = 1;
	echo $count . PHP_EOL;
	$count++;
}

myCounter(); // Outputs "1"
myCounter(); // Outputs "2"
myCounter(); // Outputs "3"
myCounter(); // Outputs "4"
myCounter(); // Outputs "5"