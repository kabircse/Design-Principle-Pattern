# Inheritance
**Inheritance:** Inheritance in PHP﻿ is a feature that allows a new class to be created from an existing class. This new class inherits the properties and methods of the existing class, and can also define its own unique properties and methods.


**Benefits of Inheritance**

There are several benefits to using inheritance in PHP. These benefits include:

* **Reusability:** Inheritance allows you to reuse code that you have already written. This can save you time and effort, and it can also help to ensure that your code is consistent.
* **Maintainability:** Inheritance can make your code easier to maintain. When you make a change to a parent class, those changes are automatically reflected in all of the child classes. This can make it easier to keep your code up-to-date and bug-free.
* **Extensibility:** Inheritance allows you to easily extend the functionality of your code. You can create new child classes that inherit from existing classes, and then add new features to those child classes. This can make it easy to add new features to your code without having to rewrite large amounts of code.

**Types of Inheritance**

There are four types of inheritance in PHP:

1. **Single inheritance:** This is the most common type of inheritance, and it occurs when a new class inherits from a single existing class.
2. **Multiple inheritance:** This occurs when a new class inherits from two or more existing classes.
3. **Hierarchical inheritance:** Refers to a structure where multiple classes are derived from a single base or parent class. In this scenario, each subclass or child class inherits properties and methods from the same parent class, creating a hierarchy of classes.
4. **Interface inheritance:** This occurs when a class implements one or more interfaces.

# Example

1. **Single inheritance:**
  
```php
class ParentClass {
  public $name;

  public function __construct($name) {
    $this->name = $name;
  }

  public function getName() {
    return $this->name;
  }
}

class ChildClass extends ParentClass {
  public $age;

  public function __construct($name, $age) {
    parent::__construct($name);
    $this->age = $age;
  }

  public function getAge() {
    return $this->age;
  }
}

$child = new ChildClass('John Doe', 30);
echo $child->getName(); // John Doe
echo $child->getAge(); // 30
```

In this example, the `ChildClass` inherits from the `ParentClass`. This means that the `ChildClass` has all of the properties and methods of the `ParentClass`, in addition to its own properties and methods.

The `ChildClass` constructor calls the `ParentClass` constructor using the `parent` keyword. This passes the value of the `$name` parameter to the `ParentClass` constructor, which sets the value of the `$name` property.

The `ChildClass` also has its own `$age` property and `getAge()` method.

The `$child` variable is an instance of the `ChildClass`. We can use the `getName()` and `getAge()` methods to access the `$name` and `$age` properties of the `$child` object.


2. **Multiple inheritance Example:**
   Multiple inheritance is not supported in PHP. However, there are several ways to achieve similar results.

**a. Using Interfaces:**

Interfaces define a set of methods that a class must implement. By implementing multiple interfaces, a class can inherit methods from those interfaces. For example:

```php
interface Drawable {
    public function draw();
}

interface Shape {
    public function getArea();
}

class Circle implements Drawable, Shape {
    public function draw() {
        // Draw a circle
    }

    public function getArea() {
        // Calculate the area of the circle
    }
}

$circle = new Circle();
$circle->draw();
$circle->getArea();
```

In this example, the `Circle` class implements both the `Drawable` and `Shape` interfaces. This allows it to inherit the `draw()` and `getArea()` methods from those interfaces.

**b. Using Traits:**

Traits are similar to interfaces, but they can contain both method and property declarations. This allows you to reuse code between classes more easily. For example:

```php
trait Drawable {
    public function draw() {
        // Draw a circle
    }
}

trait Shape {
    public function getArea() {
        // Calculate the area of the circle
    }
}

class Circle {
    use Drawable, Shape;
}

$circle = new Circle();
$circle->draw();
$circle->getArea();
```

In this example, the `Circle` class uses the `Drawable` and `Shape` traits. This allows it to inherit the `draw()` and `getArea()` methods from those traits.

**c. Using Abstract Classes:**

Abstract classes are classes that cannot be instantiated directly. They can only be used as parent classes for other classes. Abstract classes can contain abstract methods, which must be implemented by the child classes. For example:

```php
abstract class Shape {
    abstract public function getArea();
}

class Circle extends Shape {
    public function getArea() {
        // Calculate the area of the circle
    }
}

$circle = new Circle();
$circle->getArea();
```

In this example, the `Shape` class is an abstract class that defines the `getArea()` method. The `Circle` class extends the `Shape` class and implements the `getArea()` method. This allows the `Circle` class to inherit the `getArea()` method from the `Shape` class.

**d. Using Composition:**

Composition is a design pattern that allows you to create a new object by combining multiple existing objects. For example:

```php
class Drawing {
    private $shapes = [];

    public function addShape(Shape $shape) {
        $this->shapes[] = $shape;
    }

    public function draw() {
        foreach ($this->shapes as $shape) {
            $shape->draw();
        }
    }
}

$drawing = new Drawing();
$drawing->addShape(new Circle());
$drawing->addShape(new Rectangle());

$drawing->draw();
```

In this example, the `Drawing` class contains an array of `Shape` objects. The `addShape()` method adds a new `Shape` object to the array. The `draw()` method calls the `draw()` method on each `Shape` object in the array. This allows the `Drawing` class to draw multiple shapes at once.

Each of these techniques has its own advantages and disadvantages. The best approach for a particular situation will depend on the specific requirements of the application.


3. **Hierarchical inheritance:**
```php
class Animal {
    protected $name;
    protected $age;
    protected $species;

    public function __construct($name, $age, $species) {
        $this->name = $name;
        $this->age = $age;
        $this->species = $species;
    }

    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

    public function getSpecies() {
        return $this->species;
    }
}

class Dog extends Animal {
    protected $breed;

    public function __construct($name, $age, $species, $breed) {
        parent::__construct($name, $age, $species);
        $this->breed = $breed;
    }

    public function getBreed() {
        return $this->breed;
    }
}

class GoldenRetriever extends Dog {
    protected $color;

    public function __construct($name, $age, $breed, $color) {
        parent::__construct($name, $age, 'dog', $breed);
        $this->color = $color;
    }

    public function getColor() {
        return $this->color;
    }
}

$goldenRetriever = new GoldenRetriever('Buddy', 5, 'Golden Retriever', 'gold');

echo $goldenRetriever->getName() . ' is a ' . $goldenRetriever->getAge() . '-year-old ' . $goldenRetriever->getSpecies() . ' of the ' . $goldenRetriever->getBreed() . ' breed, and has a ' . $goldenRetriever->getColor() . ' coat.';
```

This code would output the following:

```
Buddy is a 5-year-old dog of the Golden Retriever breed, and has a gold coat.
```

**Conclusion**

Inheritance is a powerful feature that can be used to create complex and reusable code. It can save you time and effort, and it can also help to ensure that your code is consistent and maintainable.﻿
