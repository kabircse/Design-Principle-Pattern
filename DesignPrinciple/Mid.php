# 5 Design Principles described below:
1. Single Responsibility Principle (SRP)
2. Open/Closed Principle (OCP)
3. Liskov Substitution Principle (LSP)
4. Interface Segregation Principle (ISP)
5. Dependency Inversion Principle (DIP)

1. Single Responsibility Principle (SRP): A class should have one and only one reason to change, meaning that a class should have only one feature/functionality/job but not means one method. 

Bad: This class related two features, Settings and Auth.
<?php
class UserSettings
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function changeSettings(array $settings): void
    {
        if ($this->verifyCredentials()) {
            // ...
        }
    }
    private function verifyCredentials(): bool
    {
        // ...
    }
}
?>

Good:Solution
<?php
class UserAuth
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function verifyCredentials(): bool
    {
        // ...
    }
}
class UserSettings
{
    private $user;
    private $auth;
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->auth = new UserAuth($user);
    }
    public function changeSettings(array $settings): void
    {
        if ($this->auth->verifyCredentials()) {
            // ...
        }
    }
}
?>

2. Open/Closed Principle (OCP): Software entities (classes, modules, functions, etc.) should be open for extension, but closed for modification. You should allow users to add new functionalities without changing existing code.

Bad:
<?php
class Rectangle {
    public $width;
    public $height;
    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }
}
class Square {  
    public $length;    
    public function __construct($length) {
        $this->length = $length;
    }
}
class AreaCalculator {  
    protected $shapes;
    public function __construct($shapes = array()) {
        $this->shapes = $shapes;
    }
    public function sum() {
        $area = [];
        foreach($this->shapes as $shape) {
		//For another class such as Developer, what to add it manually changing 			the class, that violates the OCP
            if($shape instanceof Square) {
                $area[] = pow($shape->length, 2);
            } else if($shape instanceof Rectangle) {
                $area[] = $shape->width * $shape->height;
            }
        }  
        return array_sum($area);
    }
}
?>

Good(Refactored Solution):
<?php
interface Shape {
    public function area();
}
class Rectangle implements Shape {  
    private $width;
    private $height;    
    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }    
    public function area() {
        return $this->width * $this->height;
    }
}
class Square implements Shape {  
    private $length;    
    public function __construct($length) {
        $this->length = $length;
    }    
    public function area() {
        return pow($this->length, 2);
    }
}
class AreaCalculator {  
    protected $shapes;    
    public function __construct($shapes = array()) {
        $this->shapes = $shapes;
    }
    public function sum() {
        $area = [];        
        foreach($this->shapes as $shape) {
            $area[] = $shape->area();
        }    
        return array_sum($area);
    }
}
?>

3. Liskov Substitution Principle (LSP):
If you have a parent class and a child class, then the parent class and child class can be used interchangeably without getting incorrect results. Mathematically, a square is a rectangle, but if you model it using the "is-a" relationship via inheritance, you quickly get into trouble.
Bad:
<?php
class Rectangle
{
    protected $width = 0;
    protected $height = 0;
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }
    public function getArea(): int
    {
        return $this->width * $this->height;
    }
}
class Square extends Rectangle
{
    public function setWidth(int $width): void
    {
        $this->width = $this->height = $width;
    }

    public function setHeight(int $height): void
    {
        $this->width = $this->height = $height;
    }
}
function printArea(Rectangle $rectangle): void
{
    $rectangle->setWidth(4);
    $rectangle->setHeight(5);

    // BAD: Will return 25 for Square. Should be 20.
    echo sprintf('%s has area %d.', get_class($rectangle), $rectangle->getArea()).PHP_EOL;
}
$rectangles = [new Rectangle(), new Square()];
foreach ($rectangles as $rectangle) {
    printArea($rectangle);
}
?>

Good:
The best way is separate the quadrangles and allocation of a more general subtype for both shapes.
Despite the apparent similarity of the square and the rectangle, they are different. A square has much in common with a rhombus, and a rectangle with a parallelogram, but they are not subtype. A square, a rectangle, a rhombus and a parallelogram are separate shapes with their own properties, albeit similar.

<?php
interface Shape
{
    public function getArea(): int;
}
class Rectangle implements Shape
{
    private $width = 0;
    private $height = 0;
    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }
    public function getArea(): int
    {
        return $this->width * $this->height;
    }
}

class Square implements Shape
{
    private $length = 0;
    public function __construct(int $length)
    {
        $this->length = $length;
    }
    public function getArea(): int
    {
 	    return $this->length ** 2;
 	  }
}
function printArea(Shape $shape): void
{
    echo sprintf('%s has area %d.', get_class($shape), $shape->getArea()).PHP_EOL;
}
$shapes = [new Rectangle(4, 5), new Square(5)];
foreach ($shapes as $shape) {
    printArea($shape);
}
?>
The bottom line here is that if you find you are overriding a lot of code then maybe your architecture is wrong and you should think about the Liskov Substitution principle.  

4. Interface Segregation Principle (ISP):
ISP states that "Clients should not be forced to depend upon interfaces that they do not use."

Bad: 
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

Good:
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
The ICircle interface handles only the drawing of circles, IShape handles drawing of any shape :), ISquare handles the drawing of only squares and IRectangle handles drawing of rectangles.
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
1.High-level modules should not depend on low-level modules. Both should depend on abstractions.
2.Abstractions should not depend upon details. Details should depend on abstractions.
DIP keeps high-level modules from knowing the details of its low-level modules and setting them up. It can accomplish this through DI. A huge benefit of this is that it reduces the coupling between modules. Coupling is a very bad development pattern because it makes your code hard to refactor.

Bad:
<?php
class Mail
{
       public function send();
}
class SendWelcomeMessage {
    private $mail;
    public function __construct(Mail $mail)
    {
        $this->mailer = $mailer;
    }
}
?>

Good(Refactored Solution):
<?php
interface Mail
{
    public function send();
}
class SmtpMail implements Mail
{
    public function send()
    {
    }
}
class SendGridMail implements Mail
{
    public function send()
    {
    }
}
class SendWelcomeMessage
{
    private $mail;
    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }
}
?>
