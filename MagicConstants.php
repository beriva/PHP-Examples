<?php

function printInfo() {
    print "You are in this directory: ".__DIR__.PHP_EOL;
    print "In this file: ".__FILE__.PHP_EOL;
    print "Inside this function: ".__FUNCTION__.PHP_EOL;
    print "And around this line: ".__LINE__.PHP_EOL;
}

printInfo();
