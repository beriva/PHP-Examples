<?php

// Variable interpolation is using {} curly braces to tell a string to pull in
// the value of a variable.


// VARIABLE INTERPOLATION ONLY WORKS WITH STRINGS INSIDE DOUBLE QUOTES.

$name = "Dan Matthews";

// Then, using double quotes, print it out:
print "My Name is $name".PHP_EOL;

// Make a slightly more complicated variable, like an array:
$data = array(
    'name' => "Dan Matthews",
    'age' => 25,
);

// For arrays, we need to use curly braces, otherwise it will not interpolate correctly.
print "My name is {$data['name']}, and i am {$data['age']} years old.".PHP_EOL;

// Note how single quotes won't work at all:
print 'My name is $dan'.PHP_EOL;
