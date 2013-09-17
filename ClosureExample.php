<?php

// A Simple function assigned to a variable.
$my_function = function($number_of_people) {
    return "There are {$number_of_people} people".PHP_EOL;
};

// Call it, and pass arguments to it, like you would any other function:
print $my_function(10);

// Set a variable outside a closure then use it inside one...
$my_name = "Dan Matthews";

// ...With the 'use' keyword, it allows you to import a variable into the closure.
$name_function = function() use ($my_name) {
    return "My name is: {$my_name}".PHP_EOL;
};

// Then call it, you don't have to worry about passing in $my_name.
echo $name_function();
