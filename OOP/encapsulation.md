# Encapsulation
Encapsulation is bundling data (attributes/properties) and methods (functions/procedures) within a single unit, called a class.
It helps hide the internal state of an object and only exposes the necessary functionalities to interact with that object. It is one of the fundamental concepts of object-oriented programming (OOP) and plays a crucial role in achieving data security, data integrity, and modularity. 


### Key Points of Encapsulation in PHP:

1. **Classes:** Classes are blueprints or templates that define the structure and behavior of objects. They encapsulate data members (properties) and methods (functions) into a single unit.

2. **Objects:** Objects are instances of classes that are created at runtime. They contain data members and methods that can be accessed and manipulated.

3. **Properties (Data Members):** Properties represent the data associated with an object. They can be declared as public, protected, or private, which determines their accessibility.

4. **Methods (Member Functions):** Methods are functions defined within a class. They operate on the data members of the class and can be invoked using objects created from that class.

5. **Access Modifiers:** Access modifiers (public, protected, private) control the accessibility of properties and methods within a class.

    a. **Public:** Public members can be accessed from anywhere within the program.
    
    b. **Protected:** Protected members can be accessed by the class itself and its subclasses.
    
    c. **Private:** Private members can only be accessed within the class itself.


### Benefits of Encapsulation:

   1. **Data Security:** Encapsulation prevents direct access to data members of an object, making it more secure.

   2. **Data Integrity:** Encapsulation ensures that data members can only be modified through well-defined methods, preserving data integrity.

   3. **Modularity:** Encapsulation allows the grouping of related data and operations into logical units, making code more modular and maintainable.

   4. **Information Hiding:** Encapsulation helps in hiding implementation details, allowing developers to modify the internal structure of a class without affecting its external behavior.


**In PHP, encapsulation is achieved using the access modifiers.**

## Example:

    class Car {
        private $model;
        public $color;
        
        public function __construct($model, $color) {
            $this->model = $model;
            $this->color = $color;
        }
        
        // Getter method for private property $model
        public function getModel() {
            return $this->model;
        }
        
        // Setter method for private property $model
        public function setModel($newModel) {
            $this->model = $newModel;
        }
    }
    
    $car = new Car("Toyota", "Red");
    echo $car->color; // Accessing public property $color // Output: Red
    
    // Trying to access private property $model directly throws an error
    // echo $car->model; 
    
    // Using the getter method to access the private property $model
    echo $car->getModel(); // Output: Toyota
    
    // Using the setter method to modify the private property $model
    $car->setModel("Honda");
    echo $car->getModel(); // Output: Honda

In this example, the $model is a private property, so it cannot be accessed directly from outside the class. 
Getter and setter methods (getModel() and setModel()) are provided to read and modify the private property, respectively. This way, the internal state of the object ($model) is encapsulated within the class, allowing controlled access.
