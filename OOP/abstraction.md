# Abstraction
**Abstraction:** Abstraction in PHP is a concept used to hide the implementation details of a class or a method from the user. 
It allows you to focus on the essential aspects of the class or method without getting bogged down in the details. Abstraction is achieved using abstract classes and interfaces.

A. **Abstract Classes:** Abstract classes are classes that are declared with the abstract keyword. They can contain abstract methods, which are methods that do not have an implementation. Abstract methods must be implemented in the child classes of the abstract class.

**Example-1:** Using an abstract method with no implementations
```php
abstract class Shape {
  abstract public function getArea();
}

class Square extends Shape {
  private $sideLength;

  public function __construct($sideLength) {
    $this->sideLength = $sideLength;
  }

  public function getArea() {
    return $this->sideLength * $this->sideLength;
  }
}

class Circle extends Shape {
  private $radius;

  public function __construct($radius) {
    $this->radius = $radius;
  }

  public function getArea() {
    return pi() * $this->radius * $this->radius;
  }
}

$square = new Square(5);
$circle = new Circle(3);

echo $square->getArea(); // Output: 25
echo $circle->getArea(); // Output: 28.274333882308138
```

**Example-2:** Without abstract method just a single method with empty implementation
```php
abstract class Shape {
  public function getArea() {}
}

class Square extends Shape {
  private $sideLength;

  public function __construct($sideLength) {
    $this->sideLength = $sideLength;
  }

  public function getArea() {
    return $this->sideLength * $this->sideLength;
  }
}

class Circle extends Shape {
  private $radius;

  public function __construct($radius) {
    $this->radius = $radius;
  }

  public function getArea() {
    return pi() * $this->radius * $this->radius;
  }
}

$square = new Square(5);
$circle = new Circle(3);

echo $square->getArea(); // Output: 25
echo $circle->getArea(); // Output: 28.274333882308138
```

B. **Interfaces**

Interfaces are similar to abstract classes, but they are more restrictive. Interfaces can only contain abstract methods and constants. They cannot contain any instance variables or concrete methods.

```php
interface ShapeInterface {
  public function getArea();
}

class Square implements ShapeInterface {
  private $sideLength;

  public function __construct($sideLength) {
    $this->sideLength = $sideLength;
  }

  public function getArea() {
    return $this->sideLength * $this->sideLength;
  }
}

class Circle implements ShapeInterface {
  private $radius;

  public function __construct($radius) {
    $this->radius = $radius;
  }

  public function getArea() {
    return pi() * $this->radius * $this->radius;
  }
}

$square = new Square(5);
$circle = new Circle(3);

echo $square->getArea(); // Output: 25
echo $circle->getArea(); // Output: 28.274333882308138
```

**Benefits of Abstraction**

Abstraction offers several benefits, including:

* **Code Reusability:** By abstracting common functionality into a base class or interface, you can reuse that code in multiple child classes or implementations.
* **Maintainability:** Abstracted code is easier to maintain and update, as you only need to change the implementation in one place.
* **Extensibility:** Abstract classes and interfaces make it easy to add new features or functionality to your codebase without breaking existing code.
* **Modularity:** Abstracted code is more modular and can be easily combined with other modules to create new applications.

**Conclusion**

Abstraction is a powerful concept that can help you write more maintainable, reusable, and extensible code. By using abstract classes and interfaces, you can hide the implementation details of your code and focus on the essential aspects of your program.﻿
