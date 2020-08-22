5 Design Principles described below:

1. Single Responsibility Principle (SRP): A class should have one and only one reason to change, meaning that a class should have only one feature/functionality/job but not means one method.
So, as an example - an online store with orders, products and customers. The principle states that the only responsibility - "one single duty should be imposed on each object." In other words - a specific class must solve a specific task - no more and no less. Consider the following description of the class to represent the order in the online store:

Bad: This class related 3 features. work with every order (calculateTotalSum, getItems, getItemsCount, addItem, deleteItem), display order (printOrder, showOrder) and data handeling (load, save, update, delete).
<?php
class Order
{
    public function getItems(){/*...*/}
    public function addItem($item){/*...*/}
    public function deleteItem($item){/*...*/}

    public function printOrder(){/*...*/}
    public function showOrder(){/*...*/}

    public function update(){/*...*/}
    public function delete(){/*...*/}
}
?>

Good (Solution):
<?php
class Order
{
    public function getItems(){/*...*/}
    public function addItem($item){/*...*/}
    public function deleteItem($item){/*...*/}
}
class OrderRepository
{
    public function update($order){/*...*/}
    public function delete($order){/*...*/}
}
class OrderViewer
{
    public function printOrder($order){/*...*/}
    public function showOrder($order){/*...*/}
}
?>
Now each class is engaged in the specific task and for each class there is only one reason to change it.

2. Open/Closed Principle (OCP): Software entities (classes, modules, functions, etc.) should be open for extension, but closed for modification. You should allow users to add new functionalities without changing existing code.

Bad:
<?php
class OrderRepository {
    public function load($orderID)
    {
        $pdo = new PDO(
            $this->config->getDsn(),
            $this->config->getDBUser(),
            $this->config->getDBPassword()
        );
        $statement = $pdo->prepare("SELECT * FROM `orders` WHERE id=:id");
        $statement->execute(array(":id" => $orderID));
        return $query->fetchObject("Order");
    }    
    public function save($order){/*...*/}
    public function update($order){/*...*/}
    public function delete($order){/*...*/}
}?>
In this case, we have a repository database, for example: MySQL. But suddenly we want to load our data on orders via API of the third-party server.
What changes do we need to make? There are several options, for example: to directly modify class methods OrderRepository, but this does not comply with the principle of opening / closing, since the class is closed to modifications, and changes to the already well working class is not desirable. So, you can inherit from OrderRepository class and override all the methods, but this solution is also not the best, because when you add a method to OrderRepository we have to add similar methods to all his successors. Therefore, to satisfy the principle of opening / closing is better to use the following solution - to establish interface IOrderSource, which will be implemented by the respective classes MySQLOrderSource, ApiOrderSource and so on.

Good(Refactored Solution):
<?php
class OrderRepository
{
    private $source;
    public function setSource(IOrderSource $source)
    {
        $this->source = $source;
    }
    public function load($orderID)
    {
        return $this->source->load($orderID);
    }    
    public function save($order){/*...*/}
    public function update($order){/*...*/}
}
interface IOrderSource
{
    public function load($orderID);
    public function save($order);
    public function update($order);
    public function delete($order);
}
class MySQLOrderSource implements IOrderSource
{
    public function load($orderID);
    public function save($order){/*...*/}
    public function update($order){/*...*/}
    public function delete($order){/*...*/}
}
class ApiOrderSource implements IOrderSource
{
    public function load($orderID);
    public function save($order){/*...*/}
    public function update($order){/*...*/}
    public function delete($order){/*...*/}
}?>

Thus, we can change the behavior of the source and accordingly to OrderRepository class, setting us right class implements IOrderSource, without changing OrderRepository class.

3. Liskov Substitution Principle (LSP):
If you have a parent class and a child class, then the parent class and child class can be used interchangeably without getting incorrect results. Mathematically, a square is a rectangle, but if you model it using the "is-a" relationship via inheritance, you quickly get into trouble.

Bad:
<?php
class Rectangle
{
    protected $width;
    protected $height;
    public setWidth($width)
    {
        $this->width = $width;
    }
    public setHeight($height)
    {
        $this->height = $height;
    }
    public function getWidth()
    {
        return $this->width;
    }
    public function getHeight()
    {
        return $this->height;
    }
}
class Square extends Rectangle
{
    public setWidth($width)
    {
        parent::setWidth($width);
        parent::setHeight($width);
    }
    public setHeight($height)
    {
        parent::setHeight($height);
        parent::setWidth($height);
    }
}
function calculateRectangleSquare(Rectangle $rectangle, $width, $height)
{
    $rectangle->setWidth($width);
    $rectangle->setHeight($height);
    return $rectangle->getHeight * $rectangle->getWidth;
}
calculateRectangleSquare(new Rectangle(), 4, 5); // 20
calculateRectangleSquare(new Square(), 4, 5); // 25 ???
?>
what's the problem? Is a "square" is not a "rectangle"? Yes, but in geometric terms. In terms of the same objects, the square is not a rectangle, because the behavior of the "square" object does not agree with the behavior of the "rectangle" object.

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

4. Interface Segregation/Separation Principle (ISP):
This principle says that "Many specialized interfaces are better than one universal". Compliance with this principle is necessary to ensure that the client classes that use or implement the interface will know only about the methods that they use, which leads to a reduction in the amount of unused code.

Let's take an example with an online store. Suppose our products can have a promotional code, a discount, they have some price, condition, etc. If this is clothing, then for it it is determined from what material is made, color and size. Let's describe the following interface:

Bad:
<?php
interface IItem
{
    public function applyDiscount($discount);
    public function applyPromocode($promocode);
    public function setColor($color);
    public function setSize($size);    
    public function setCondition($condition);
    public function setPrice($price);
}?>
This interface is not good, because it involves too many methods. And what if our class of goods can not have discounts or promotional codes, or for it there is no sense in installing the material from which it is made (for example, for books). Thus, in order not to implement methods that are not used in each class, it is better to break the interface into several smaller ones and implement the necessary interfaces by each specific class.

Good:
<?php
interface Item
{
    public function setCondition($condition);
    public function setPrice($price);
}
interface IClothes
{
    public function setColor($color);
    public function setSize($size);
    public function setMaterial($material);
}
interface IDiscountable
{
    public function applyDiscount($discount);
    public function applyPromocode($promocode);
}
class Book implemets IItem, IDiscountable
{
    public function setCondition($condition){/*...*/}
    public function setPrice($price){/*...*/}
    public function applyDiscount($discount){/*...*/}
    public function applyPromocode($promocode){/*...*/}
}
class KidsClothes implemets IItem, IClothes
{
    public function setCondition($condition){/*...*/}
    public function setPrice($price){/*...*/}
    public function setColor($color){/*...*/}
    public function setSize($size){/*...*/}
    public function setMaterial($material){/*...*/}
}
?>

5. Dependency Inversion Principle (DIP):
This principle states two essential things:
1.High-level modules should not depend on low-level modules. Both should depend on abstractions.
2.Abstractions should not depend upon details. Details should depend on abstractions.
DIP keeps high-level modules from knowing the details of its low-level modules and setting them up. It can accomplish this through DI. A huge benefit of this is that it reduces the coupling between modules. Coupling is a very bad development pattern because it makes your code hard to refactor.

Bad:
<?php
class Customer
{
    private $currentOrder = null;
    public function buyItems()
    {    
        if(is_null($this->currentOrder)){
            return false;
        }
        $processor = new OrderProcessor();
        return $processor->checkout($this->currentOrder);    
    }
    public function addItem($item){
        if(is_null($this->currentOrder)){
            $this->currentOrder = new Order();
        }
        return $this->currentOrder->addItem($item);
    }   
    public function deleteItem($item){
        if(is_null($this->currentOrder)){
            return false;
        }
        return $this->currentOrder ->deleteItem($item);
    }
}
class OrderProcessor
{
    public function checkout($order){/*...*/}
}?>
Everything seems quite logical. But there is a one problem - the Customer class depends on the OrderProcessor class (moreover, the principle of openness/closure is not fulfilled). In order to get rid of the dependence on a particular class, you need to make sure that Customer depends on abstraction, ie. From the IOrderProcessor interface. This dependency can be implemented through the setters, method parameters, or the Dependency Injection container. I decided to stop on method 2 and get the following code.

Good(Refactored Solution):
<?php
class Customer {
    private $currentOrder = null;
    public function buyItems(IOrderProcessor $processor)
    {    
        if(is_null($this→currentOrder)){
            return false;
        }
        return $processor->checkout($this->currentOrder);    
    }
    public function addItem($item){
        if(is_null($this->currentOrder)){
            $this->currentOrder = new Order();
        }
        return $this->currentOrder->addItem($item);
    }
    public function deleteItem($item){
        if(is_null($this->currentOrder)){
            return false;
        }
        return $this->currentOrder ->deleteItem($item);
    }
}
interface IOrderProcessor
{
    public function checkout($order);
}
class OrderProcessor implements IOrderProcessor
{
    public function checkout($order){/*...*/}
}?>

So now, the Customer class now depends only on the abstraction, and the specific implementation, i.e. details, it is not so important.
