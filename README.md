# Intermediate PHP.

## Quickies before we start:

We're going to quickly look at these.

- The Ternary Operator
- String/Variable interpolation

## Closures, or "anonymous functions".

Closures are functions that can be defined and passed around and used as variables. You'll see these all the time in javascript, and they're becoming a lot more widely used in PHP now, especially in frameworks.

You define a Closure by using a function keyword like so, and assign it to a variable.

```php
<?php
$myFunction = function () {
	echo "Hello";
	return 200;
};
```

And you can use it by adding parentheses () to the variable:

```php
<?php
$returnValue = $myFunction();
echo $returnValue; // 200
```

They can be used as 'callbacks' - a chunk of functionality to run after or before another set of functionality.

For example, from Laravel's router:

```php
<?php

Route::get('/', function()
{
    return 'Hello World';
});

```

>This is basically saying 'when the URL matches this, run the function passed as the second argument'

## Looking at objects and classes again.

![Huh](http://i.imgur.com/dhhhvdc.jpg)

Objects and classes (which are PRETTY MUCH the same thing) are the foundation of modern PHP, Drupal uses them extensively under the hood, and this will become even more the case when Drupal 8 comes out. So we're just going to go over the other stuff again and introduce a few more ideas into the mix.

### Basic Classes.

A class is the definition of an object - the **blueprint** for what the class can and can't do.

```php
<?php

class Bar {

	public $data;

	public function makeMeASandwich() {
		echo "Make your own damn sandwich!";
    }
}
```

The above class has one property `$data`, and one method (function), `makeMeASandwich()`.

### Instantiating ("creating an instance of") an object.

We all know how to create an *instance* of an object by now:

```php
$foo = new Bar();
```

And we all know that we can call methods on an instance of an object, if that method exists:

```php
$bar = $foo->makeMeASandwich();
```

And that an instance of an object has *properties*

```php
$data = $foo->data;
echo $data;
```

### Passing data to a class.

When you use the `new` keyword to create a new instance of a class, you sometimes see people passing data to the class upon creating an instance, like:

```php
$class = new FooClass($data);
```

When people do this, the data gets passed to the `__construct()` function inside the class, and from there, you can do with it what you want.

```php
class FooClass {
	public function __construct($data) {
		// From here, you can do what you want with the $data.
	}
}
```

Whatever arguments the `__construct()` function has, are the arguments it expects when it gets instantiated:

```php
class FizzyPop {
	public function __construct($flavour, $size) {
		// This expects a flavour and a size.
	}
}

// Usage:
$soda = new FizzyPop("Coke", "2 Litres");

```

Arguments act just like arguments to functions, so you can supply default values to make them non-required.

### Using data inside a class.

When you're inside a class, you can use the wonderful `$this` variable to access the properties and methods of your class from inside your class functions.

```php
class FizzyPop {
	public $flavour;
	public $size;
	public function __construct($flavour, $size) {
		// Assign the values passed to the class to the properties.
		$this->flavour = $flavour;
		$this->size = $size;
	}
}

// Usage:
$soda = new FizzyPop("Orange Fanta", "500ml");
echo $soda->size; // Prints '500ml'
echo $soda->flavour; // Prints 'Orange Fanta'
```

You can also call functions from inside the class:

```php
class FizzyPop {
	public $flavour;
	public $size;
	public function __construct($flavour, $size) {
		// Assign the values passed to the class to the properties.
		$this->flavour = $flavour;
		$this->size = $size;
		// Call the method.
		$this->printFlavour();
	}
	public function printFlavour() {
		echo $this->flavour;
	}
}

// Usage:
$soda = new FizzyPop("Dr Pepper", "500ml"); // Will automatically call 'printFlavour' and print out 'Dr Pepper';
```


## Public, private, protected.

Methods and properties in a class can be declared as `public`, `private`, or `protected`.


### Public methods and properties.

Public methods and properties can be accessed by anyone using the class, this is typically what most people default their methods and properties to, even though they probably shouldn't.

```php
class HasPublicStuff {
	public $time;
	public myMethod() {
		echo 'This is public';
	}
}

// Then, when using it:
$class = new HasPublicStuff;
$class->time = '10pm'; // Works.
$class->myMethod(); // Works.

```

### Private methods and properties.

Private methods and properties can **only be accessed from within the class they're declared in.** This means that any sub-classes (we'll talk about this later on) cannot access them. Not a lot of people i know use `private` keywords in their classes.

```php
class HasPrivateStuff {
	private $time;
	private myMethod() {
		echo 'This is private';
	}
}

// Then, when using it:
$class = new HasPrivateStuff;
$class->time = '10pm'; // DOES NOT WORK.
$class->myMethod(); // DOES NOT WORK.

```

![Boromir](http://i.imgur.com/4siOckV.jpg)

### Protected methods and properties.

Now, if you've got a property or a method that you don't want someone outside your class to use, BUT you want it to be accessible by subclasses (trust me here, in most cases, you do), then you want the protected keyword. It'll stop people outside your class using it directly, but will allow for greater flexibility down the line. Most classes you see nowadays use a mix of protected and public properties and methods.


```php
class HasProtectedtuff {
	protected $time;
	protected myMethod() {
		echo 'This is protected';
	}
}

// Then, when using it:
$class = new HasProtectedStuff;
$class->time = '10pm'; // DOES NOT WORK.
$class->myMethod(); // DOES NOT WORK.

```

## Magic methods

MAGIC methods, that's right - you heard correctly, FREAKIN MAGIC.

Magic methods can be placed within a class and will perform certain actions in special situations, **all magic methods start with two underscores.**

You'll have heard of one or two magic methods by now, at least the `__construct()` and `__destruct()` methods.

`__construct()` is called automatically when creating a new instance of an object.

`__destruct()` is called automatically when getting rid of the object, this is done by calling `unset()`, or PHP will do it when it needs memory.


```php
class Sandwich {

	public function __construct() {
		echo 'Making a sandwich';
	}

	public function __destruct() {
		echo 'Getting rid of the sandwich';
	}

}

$s = new Sandwich; // Echoes out 'Making a sandwich';
unset($s); // Echoes out 'Getting rid of the sandwich';

```

There's another couple of great magic methods: `__toString()` and `__invoke()`.

###`__toString()`

This is used when you want to get a string representation of an object - this means that if someone passes an instance of an object to an `echo` or `print` function, or tries to use it in a string.

```php
class FizzyPop {
	public $flavour;
	public $size;
	public function __construct($flavour, $size) {
		// Assign the values passed to the class to the properties.
		$this->flavour = $flavour;
		$this->size = $size;
		// Call the method.
		$this->printFlavour();
	}
	public function __toString() {
		// Turn the flavour and size into a string and return it.
		return "The flavour is {$this->flavour} and the size is {$this->size}.";
	}
}
// Usage:
$soda = new FizzyPop("Dr Pepper", "500ml");
echo $soda; // Normally this would just say 'object', but now it says 'The flavour is Dr Pepper and the size is 500ml'.
```

### `__invoke()`

This is used when you want to call an instance of an object like a function (did you know you can call variables and objects as functions)?

```php
class FizzyPop {
	public $flavour;
	public $size;
	public function __construct($flavour, $size) {
		// Assign the values passed to the class to the properties.
		$this->flavour = $flavour;
		$this->size = $size;
		// Call the method.
		$this->printFlavour();
	}
	public function __invoke() {
		// Turn the flavour and size into a string and return it.
		echo "The flavour is {$this->flavour} and the size is {$this->size}.";
	}
}
// Usage:
$soda = new FizzyPop("Dr Pepper", "500ml");
echo $soda(); // Notice the brackets?, it should echo 'The flavour is Dr Pepper and the size is 500ml'.
```

## Static functions and properties.

Static functions and properties are useful for a few things:

1. Grouping methods together into a re-usable set of logic.
2. Replacing "global" variables by using a static varibale to store information as part of the request.
3. Acting as easy-to-read facades for normal OOP functions (I'll get into this later).

### What a static function looks like.

You'll see static functions being called like: `ClassName::functionName($arguments)`.

>Note: The double-colon (`::`) used to call static methods is called the "Scope resolution operator", it also has a really weird name when throwing errors, it's called a "T_PAAMAYIM_NEKDOTAYIM" and that's hebrew for double colon, because the guy who wrote PHP originally actually spoke hebrew.

And you'll see it declared very similarly to a normal class function, except it uses the `static` keyword:

```php
class HasStaticStuff {
	public static function helloWorld() {
		echo 'Hello World';
	}
}

// Usage:
HasStaticStuff::helloWorld(); // Prints Hello world.
```

### What a static variable looks like.

In the same way that the only difference between a normal class function and a static function is the `static` keyword, the same applies to variables:


```php
class HasStaticStuff {
	public static $time;
}

// Usage:
HasStaticStuff::$time = "12pm"; // Set it.
echo HasStaticStuff::$time; // Prints '12pm';
```

### The `static` keyword.

Inside a static class, you can't use the `$this` variable - because it **isn't an instance**. But you still might have another static method that you want to call from within a static method, or you might want. Essentially, when working with static methods, the `$this` variable simply becomes `static` - it's a little confusing at first, but you'll soon catch on.

```php
class HasStaticGoodness {

	public static function StaticOne()
	{
	    // Call the other static method in this class.
		static::StaticTwo();
	}

	public static function StaticTwo()
	{
		echo 'Hello, i\'m static method two';
	}

}

// Usage:

HasStaticGoodness::StaticOne(); // Will print 'Hello, i'm static method two'

```


### Mixing static and non-static.

This is perfectly valid and loads of people do it. In fact, some people use what we call 'static initialisers' to simplify getting an instance of an object:

```php
class MyAwesomeClass {

	public $name;
	public $age;

	// Notice there's no construct function!

	// Static
	public static function initWithNameAndAge($name, $age)
	{
		$instance = new static; // Notice instead of the class name, we're using the static keyword.
		$instance->name = $name;
		$instance->age = $age;
		return $instance;
	}

	// Not static.
	public function whatsMyAgeAgain()
	{
		print $this->age;
	}

}

```

Then you can do:

```php
// Create a new instance of the object using the static method:
$instance = MyAwesomeClass::initWithNameAndAge("Dan Matthews", 24);

// Now we can call object methods on $instance.
echo $instance->whatsMyAgeAgain(); // Prints 24.
```

### Usage Example: Grouping methods in a class.

Below is an example of methods from Stripe's `Stripe_Customer` class, they use static methods to make things accessible and easy to read, but they're grouped together in a class so that you know where to look for functions to do with Customers.

```php
public static function retrieve($id, $apiKey=null)
{
	$class = get_class();
	return self::_scopedRetrieve($class, $id, $apiKey);
}

public static function all($params=null, $apiKey=null)
{
	$class = get_class();
	return self::_scopedAll($class, $params, $apiKey);
}

public static function create($params=null, $apiKey=null)
{
	$class = get_class();
	return self::_scopedCreate($class, $params, $apiKey);
}
```

### Usage Example: passing around data using static variables.

One of the trickiest parts of programming is persistance - keeping data accessible between different functions without having to do slow things like write it to a database or to a file.

I came across this problem while writing CloudCPD - i needed access to a very large chunk of data that would be incredibly slow to write to a database, i could use a caching system, but at the time all we had was Drupal's cache, which just writes to the database or files, exactly what i was trying to avoid.

Now this approach isn't recommended for huge amounts of data - i learned that the hard way, it slows sites to a standstill sometimes, but for small values, using a static property as a little 'data store' that is accessible from wherever in your script is fine.

```php
function runThisOneFirst()
{
	MyClass::$myValue = "Hello There";
}

function runThisOneSecond()
{
	echo MyClass::$myValue;
}

runThisOneFirst(); // Sets the value.
runThisOneSecond(); // prints "Hello there";

```

A great idea might be to use static variables / functions to replace the `global $user` object in drupal:

```php
// Either

User::$current;

// Or:

User::getCurrent();
```

## Inheritance.

No, not the money that your parents leave for you when they pass on. Well, kinda like that, but not at all.

Inheritance is when one class **extends** another class, meaning that you have a parent class, and a child class (or `subclass`).

### But Why?

Extending a class allows you to create specialist classes that contain methods that the parent class might not need, without perhaps adding bulk to the original class.

- Subclasses automatically have access to all the public and protected methods and properties from their parent class.
- Subclasses can override methods from the parent class.
- Used a lot in frameworks for controllers.

### Example:

```php
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

```

See how the second class has nothing in it, but i can still use the `whatIsMyName()` method? That's inheritance bitches.

### A more extensive example.

Usually, websites explain inheritance using a car metaphor, and who am i to break with tradition?

Now, say you have a class that describes a few parts of a general car, and has a few methods for general car functions.

```php
<?php

class Car {

	protected $engine_size;
	protected $colour;
	protected $make;
	protected $model;

	public function __construct($engine_size, $colour, $make, $model)
	{
		$this->engine_size = $engine_size;
		$this->colour = $colour;
		$this->make = $make;
		$this->model = $model;
	}

	public function startEngine()
	{
		echo "Starting engine of your {$this->colour} {$this->engine_size} {$this->make} {$this->model}"";
	}

	public function honkHorn()
	{
		echo 'Honked horn…';
	}
}
```

> **Note:** When you see curly brackets with variables inside a string like `$name = "this is my {$myvariable}";` inside strings, this is called variable interpolation, and can only be used with double quoted strings (`"`). The curly braces won't print, but the value of the variable inside it will.

Ok, so that describes pretty much every car ever, it has an engine, it can start the engine and it can honk it's horn.

And here's how we use it:

```php
// Create an instance of the car.
$car = new Car("2 Litre", "Red", "VW", "Golf");

// Start the engine.
$car->startEngine(); // This should print 'Starting engine of your red 2 litre VW Golf'.
```

#### Adding new features.

What about a more modern feature filled car? It still has all these but it has more features.

- So we **could** update the class to include these new features but that would add stuff to the class that we'd rarely use.
- We could also copy all of this and create a new class with the new features added.
- OR, we could create a new subclass that has the new features, but makes use of the old ones too.

As you might have guessed, we're going to do the third to keep our code DRY.

>**Note:** DRY = Don't Repeat Yourself, it's all about maximising code re-use.

So here's our new `Modern_Car` class:

```php
<?php

class Modern_Car extends Car {

	protected $sat_nav;
	protected $heated_seats;
	protected $paddle_shift;

	public function __construct($engine_size, $colour, $make, $model, $sat_nav, $heated_seats, $paddle_shift)
	{
		// We can still access these properties because we're extending Car.
		$this->engine_size = $engine_size;
		$this->colour = $colour;
		$this->make = $make;
		$this->model = $model;

		// Set our new properties.
		$this->sat_nav = $sat_nav;
		$this->heated_seats = $heated_seats;
		$this->paddle_shift = $paddle_shift;
	}

	public function hasHeatedSeats()
	{
		return (bool) $this->heated_seats;
	}

	public function hasSatNav()
	{
		return (bool) $this->sat_nav;
	}

	public function hasPaddleShift()
	{
		return (bool) $this->paddle_shift;
	}

}

```

And here it is in use:

```php
// New nissan qasquai with sat nav, but no heated seats and no paddleshift.
$newCar = new Modern_Car("3 Litre", "Black", "Nissan", "Qasquai", TRUE, FALSE, FALSE);

if ($newCar->hasSatNav()) { // Returns TRUE;
	echo 'Has Sat Nav!';
}
```

> Using classes like this allows us to keep maximum code re-use while still making our classes very specific for certain implementations.

## Namespaces

'Namespacing' allows you to create classes that have the same name as common tasks, but will not conflict with each other or throw "cannot redeclare function" errors.

For example: this wouldn't be acceptable:

```php
<?php # SqliteDatabaseConnection.php
Class Database {
	function connect()
	{
		// Connects to an sqlite database.
	}
}
?>
```
```php
<?php # MysqlDatabaseConnection.php
Class Database {
	function connect()
	{
		// Connects to a mysql database.
	}
}
?>
```

This would result in PHP telling us that two Classes have the same name, which is obviously not allowed, so instead of calling one `MysqlDatabase` or `SqliteDatabase`, we can use namespaces to logically structure our code:

```php
<?php #MysqlDatabaseConnection.php
	namespace Database\Connectors;
	class Mysql {

	}
	class Sqlite {

	}
?>
```

And now we can use this class using this syntax:

```php
// Get a Mysql Connection
$database = new Database\Connectors\Mysql();

// Get a Sqlite Connection
$sqliteDatabase = new Database\Connectors\Mysql();
```

## Model View Controller.

> MVC Stands for Model-View-Controller, and describes the three big parts of your application.

MVC is an 'architecture' that has grown massively in popularity lately, examples of things using it are:

- Symfony (PHP Framework)
- Ruby On Rails (Ruby Framework)
- Django (Python web framework)
- .NET MVC (C++ / C#)
- Laravel / FuelPHP / CakePHP / Zend Framework.
- Cocoa and Cocoa Touch (Objective-C : what iPhone and mac apps are written in)

### Controller

The controller is the heart of your application, it handles all incoming data from the HTTP Request, GET & POST parameters, talks to the **Model** and sets up the **View**.

### Model

This is your application's data source - it does the work of talking to the database or an API and getting the information you need to send back to the **controller**.

### View

This is the HTML portion of your application - a view receives information from the **Controller** and turns it into HTML and CSS to display to the user.

### Router

Although not part of the MVC acronym, all MVC web frameworks would almost be pointless without a router. A router is a piece of software that listens for HTTP connections and points them to the correct controller.

### Why this architecture is good.

It's important because it promotes **seperation of concerns**, where you seperate the code that talks to your database, from the code that handles incoming requests, from the code that outputs the data to the screen.

And why is seperation important? because imagine if you come to update the site and need to switch out large chunks of it - say you need to change the database that it uses, or you need to change the templating language it uses because of a security issue. Seperation of concerns allows you to replace just the component you need to, without







