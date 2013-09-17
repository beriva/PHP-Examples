<?php

// Set up a really simple class.
class MyClass {
    static $myValue;
}

// This function sets the value in memory.
function runThisOneFirst()
{
    MyClass::$myValue = "This value was set using the first function!".PHP_EOL;
}

// This function reads it and prints it out
function runThisOneSecond()
{
    echo "The first function said: ".MyClass::$myValue;
}

runThisOneFirst(); // Sets the value.
runThisOneSecond(); // prints "Hello there";
