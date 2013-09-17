<?php

class HasStaticStuff {
    public static function helloWorld() {
        echo 'Hello World from a static class!'.PHP_EOL;
    }
}

// Usage:
HasStaticStuff::helloWorld(); // Prints Hello world.
