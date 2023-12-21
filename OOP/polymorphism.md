# Polymorphism
**Polymorphism**: Polymorphism in PHP refers to the ability of objects of different classes to respond to the same method call in different ways. It allows you to write code that can work with different classes without having to modify the code itself. PHP supports polymorphism through method overriding and interfaces.


There are two primary types of polymorphism in PHP:

1. **Compile-Time(CT) Polymorphism:**
This is achieved through method overloading or function overloading, where multiple methods or functions with the same name but different parameters or arguments are defined within the same scope. However, PHP does not support method overloading directly.

Example-1:
```php
        class Animal {
            public function makeSound($sound = null) {
                return $sound;
            }
        }

        $animal = new Animal();
        $animal->makeSound('Hamba ..'); // Cow sound
        $animal->makeSound('Roar ..');  // Lion sound    
```
    

2. **Run-Time(RT) Polymorphism:**
Run-time polymorphism is more commonly used and is achieved through method overriding and interface implementation.

 * **Method Overriding:** When a child class provides a specific implementation of a method that is already defined in its parent class. The method in the child class overrides the method in the parent class.
Example-1:
```php
class Animal {
    public function makeSound() {
        return "Some generic sound";
    }
}

class Dog extends Animal {
    public function makeSound() {
        return "Bark";
    }
}

class Cat extends Animal {
    public function makeSound() {
        return "Meow";
    }
}

$dog = new Dog();
$cat = new Cat();

echo $dog->makeSound(); // Output: Bark
echo $cat->makeSound(); // Output: Meow
```

* **Interface Implementation:** PHP interfaces define a set of methods that a class must implement. Different classes can implement the same interface, and objects of these classes can be used interchangeably through the interface.

 Example-1:
 ```php
 interface Shape {
    public function calculateArea();
}

class Circle implements Shape {
    public $sideLength;
    public function __construct($sideLength = null) {
         $this->sideLength = $sideLength;
    }    
    public function calculateArea() {
        // Calculation logic for circle's area
        return pi*$this->sideLength*$this->sideLength;
    }
}

class Square implements Shape {
    public $sideLength;
    public function __construct($sideLength = null) {
         $this->sideLength = $sideLength;
    }    
    public function calculateArea() {
        // Calculation logic for square's area
        return $this->sideLength*$this->sideLength;
    }
}

function printArea(Shape $shape) {
    echo $shape->calculateArea();
}

$circle = new Circle(4);
$square = new Square(5);

printArea($circle); // Output: Circle's area
printArea($square); // Output: Square's area
```

In summary, polymorphism in PHP allows for more flexible and reusable code by treating different objects as instances of a common superclass or through a shared interface, enabling code to work seamlessly with various object types.
