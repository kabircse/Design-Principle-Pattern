# Encapsulation
Encapsulation is bundling data (attributes/properties) and methods (functions/procedures) within a single unit, called a class.
Encapsulation helps hide the internal state of an object and only exposes the necessary functionalities to interact with that object. 

### In PHP, encapsulation is achieved using the access modifiers:
**Public:** Public properties or methods can be accessed from outside the class as well as from within the class and its subclasses.

**Private:** Private properties or methods can only be accessed from within the class that defines them.

**Protected:** Protected properties or methods can be accessed within the class that defines them and any subclasses that inherit from that class.

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
