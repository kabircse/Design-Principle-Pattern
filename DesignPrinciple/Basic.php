#Design Principle:
Design principle is a guideline for developing software that are easy to maintain and extend.

Benefit:
Clean code, Code smells, Maintainable and expandable, Integrated in Agile methodologies.

1. Single Responsibility Principle (SRP): A class should have one and only one reason to change, meaning that a class should have only one feature/functionality/job but not means one method. 

Bad (Violation SRP): This class related two features, animal properties and animal database management. 
<?php
class Animal {
     constructor(name: string){ }
     getAnimalName() { }
     saveAnimal(a: Animal) { }
}
?>

Good (Refactored Solution): 
<?php
class Animal {
    constructor(name: string){ }
    getAnimalName() { }
}
class AnimalDB {
    getAnimal(a: Animal) { }
    saveAnimal(a: Animal) { }
}
?>
We refactored the problem separating two classes according to their related job.

2. Open/Closed Principle (OCP): Software entities (classes, modules, functions, etc.) should be open for extension, but closed for modification. You should allow users to add new functionalities without changing existing code.

Bad (Violation OCP): For every new animal, a new logic have to add to the AnimalSound function. When your application grows and becomes complex, you will see that if statement would be repeated over and over again in the AnimalSound function.
<?php
class Animal {
     constructor(name: string){ }
     getAnimalName() { }
}
const animals: Array<Animal> = [
    new Animal('lion'),
    new Animal('mouse')
];
function AnimalSound(a: Array<Animal>) {
    for(int i = 0; i <= a.length; i++) {
        if(a[i].name == 'lion')
            log('roar');
        if(a[i].name == 'mouse')
            log('squeak');
    }
}
AnimalSound(animals);
?>

Good (Refactored Solution):
<?php
class Animal {
    makeSound();
}
class Lion extends Animal {
    makeSound() {
        return 'roar';
    }
}
class Squirrel extends Animal {
    makeSound() {
        return 'squeak';
    }
}
class Snake extends Animal {
    makeSound() {
        return 'hiss';
    }
}

function AnimalSound(a: Array<Animal>) {
    for(int i = 0; i <= a.length; i++) {
        log(a[i].makeSound());
    }
}
AnimalSound(animals);
?>
Now, if we add a new animal, AnimalSound doesn’t need to change. All we need to do is add the new animal to the animal array. AnimalSound now conforms to the OCP principle.

3. Liskov Substitution Principle (LSP):
LSP states that objects of the same superclass should be able to be swapped with each other without breaking anything.
If we have a Cat and a Dog class derived from an Animal class, any functions using the Animal class should be able to use Cat or Dog and behave normally.

Bad (Violation Liskov): In this example animal classes fly method return string, but dog fly method returns objet. It violated Liskov. According to Liskov super class and child class return type must be same on the exchanging the class object.
<?php
class Animal
{
    public function fly() {
	return ‘Can fly’;  //returning string
   }
}
class Dog extends Animal
{
    public function fly() {
        if (! $this->hasWings) {
            throw new Exception; // violates Liskov Substitution Principle, because it returns object, but according to LSP return type shoud be same.
        }
    }
}
class Duck extends Animal {
    public function fly() {
        if ( $this->hasWings) {
            return ‘Can fly’;
        }
    }
}
?>

Note that both of these classes implement Animal’s fly method, but one returns a string, and the other returns an object. This is a LSP violation - I cannot use them interchangeably, as any place I use them, I have to check if the return value is an object, or a string, but return type must be similar.
Based on this example, if your code use the Animal class to fly(), because your program handles birds, and that you substitute Animal with Dog (which is an animal, but can't fly) then the output of your code will change(return type). This violates the Liskov Substitution Principle.

Good (Refactored/Solution):
The best way is separate the quadrangles and allocation of a more general subtype for both shapes.
Despite the apparent similarity of the square and the rectangle, they are different. A square has much in common with a rhombus, and a rectangle with a parallelogram, but they are not subtype. A square, a rectangle, a rhombus and a parallelogram are separate shapes with their own properties, albeit similar.

<?php
class Animal {
    fly();
}
class Lion extends Animal{
    fly() {
    }
} 
class Mouse extends Animal{
    fly() {
    }
}
function AnimalLegCount(a: Array<Animal>) {
	for(let i = 0; i <= a.length; i++) {
		a[i].fly();
	}
}
$animals = [new Lion(4), new Mouse(2)];
AnimalLegCount(animals);
?>

The bottom line here is that if you find you are overriding a lot of code then maybe your architecture is wrong and you should think about the Liskov Substitution principle.  

4. Interface Segregation Principle (ISP):
ISP states that "Clients should not be forced to depend upon interfaces that they do not use."

Bad (Violation ISP):
<?php
interface IShape {
    drawCircle();
    drawSquare();
}
class Circle implements IShape {
    drawCircle(){
        //...
    }   
    drawSquare(){
        //...
    }
    drawRectangle(){
        //...
    }    
}
class Square implements IShape {
    drawCircle(){
        //...
    }
    drawSquare(){
        //...
    }    
    drawRectangle(){
         //...
   }    
}
?>

Circle implements methods (drawSquare) it has no use of, likewise Square implementing drawCircle. We may add another method to the IShape interface, like drawTriangle(). Then the classes must implement the new method or error will be thrown.

Good (Refactored/Solution): 
<?php
interface IShape {
    draw();
}
interface ICircle {
    drawCircle();
}
interface ISquare {
    drawSquare();
}
class Circle implements ICircle {
    drawCircle() {
        //...
    }
}
class Square implements ISquare {
    drawSquare() {
        //...    
    }
}
class CustomShape implements IShape {
   draw(){
      //...
   }
}
?>
The ICircle interface handles only the drawing of circles, IShape handles drawing of any shape :), ISquare handles the rawing of only squares and IRectangle handles drawing of rectangles.
OR
Classes (Circle, Rectangle, Square, Triangle, etc) can just inherit from the IShape interface and implement their own draw behavior.

<?php
class Circle implements IShape {
    draw(){
        //...
    }
}
class Triangle implements IShape {
    draw(){
        //...
    }
}
class Square implements IShape {
    draw(){
        //...
    }
}
class Rectangle implements IShape {
    draw(){
        //...
    }
}
?>

5. Dependency Inversion Principle (DIP)
This principle states two essential things:
	* High-level modules should not depend on low-level modules. Both should depend on abstractions.
	* Abstractions should not depend upon details. Details should depend on abstractions.
DIP keeps high-level modules from knowing the details of its low-level modules and setting them up. It can accomplish this through DI. A huge benefit of this is that it reduces the coupling between modules. Coupling is a very bad development pattern because it makes your code hard to refactor.

Bad (Violation DIP):
<?php
class Mail {
     public function send();
}
class SendWelcomeMessage {
    private $mail;
    public function __construct(Mail $mail) {
        $this->mailer = $mailer;
    }
}

// Good (Refactored Solution):
<?php
interface Mail {
    public function send();
}
class SmtpMail implements Mail {
    public function send()
    {
        // …           
    }
}
class SendGridMail implements Mail {
    public function send()
    {
        // …
    }
}
class SendWelcomeMessage {
    private $mail;
    public function __construct(Mail $mail) {
        $this->mail = $mail;
    }
}
?>
