<?php

class Foo {
   public $name = 'Dan Matthews';
   public function whatIsMyName() {
        echo $this->name;
   }
}

class Bar extends Foo {

}

$bar = new Bar;

$name = $bar->name; // $name = 'Dan Matthews';

$bar->whatIsMyName(); // Prints 'Dan Matthews';
