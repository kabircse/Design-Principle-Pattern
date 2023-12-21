# Design Principle
**Design Principle:** The Design principle is a series of guidelines that developers can use to build software in an easy way to maintain and extend.
//Design principle is a set of guidelines that ensure the OOP concept.

**SOLID principle:**
1. **Single Responsibility Principle (SRP)**: A class should have only one reason to change.
2. **Open-closed Principle (OCP)**: Entities should be open for extension but closed for modification.
3. **Liskov Substitution Principle (LSP)**: Objects of a superclass should be replaceable with objects of its subclasses without affecting the correctness of the program.
4. **Interface Segregation Principle (ISP)**: A client should not be forced to implement interfaces they don't use, and classes should not be forced to depend on methods they do not use.
5. **Dependency Inversion Principle (DIP)**: It states that high-level (has more dependency) modules/classes should not depend on low-level(low dependency/no dependency) modules/classes but should depend on abstractions/interfaces. Additionally, abstractions should not depend on details; rather, details should depend on abstractions.
Decoupling between modules by using abstractions (interfaces or abstract classes) to facilitate a flexible and interchangeable system.


Example not following any SOLID principle:
```php
    class Order
    {
        public function calculateTotalSum(){/*...*/}
        public function getItems(){/*...*/}
        public function getItemCount(){/*...*/}
        public function addItem($item){/*...*/}
        public function deleteItem($item){/*...*/}

        public function printOrder(){/*...*/}
        public function showOrder(){/*...*/}

        public function load(){/*...*/}
        public function save(){/*...*/}
        public function update(){/*...*/}
        public function delete(){/*...*/}
    }
``` 
    
1. Following SRP
```php
        class Order
        {
            public function calculateTotalSum(){/*...*/}
            public function getItems(){/*...*/}
            public function getItemCount(){/*...*/}
            public function addItem($item){/*...*/}
            public function deleteItem($item){/*...*/}
        }

        class OrderRepository
        {
            public function load($orderID){/*...*/}
            public function save($order){/*...*/}
            public function update($order){/*...*/}
            public function delete($order){/*...*/}
        }

        class OrderViewer
        {
            public function printOrder($order){/*...*/}
            public function showOrder($order){/*...*/}
        }
``` 
        
2. **Open-Closed Principle:**

Not following OCP:
```php
        class OrderRepository
        {
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
        }
``` 
Following OCP:   
```php
        interface IOrderSource
        {
            public function load($orderID);
            public function save($order);
            public function update($order);
            public function delete($order);
        }
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
        }
```

3. **Liskov Substitution Principle (LSP):**

Not following LSP:
```php
class Rectangle {
    public function setWidth($width) {
        // Set width
    }
    public function setHeight($height) {
        // Set height
    }

    public function getArea() {
        return $this->width * $this->height;
    }
}

class Square extends Rectangle
{
    public function setWidth($width) {
        $this->width = $this->height = $width; // Violates LSP
    }
}
```

Following LSP:

```php
class Rectangle {
    protected $width;
    protected $height;

    public function setWidth($width) {
        $this->width = $width;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function area() {
        return $this->width * $this->height;
    }
}

class Square extends Rectangle {
    public function setWidth($width) {
        $this->width = $width;
        $this->height = $width;
    }

    public function setHeight($height) {
        $this->width = $height;
        $this->height = $height;
    }
}

$rectangle = new Square();
$rectangle->setWidth(5);
$rectangle->setHeight(4);

echo $rectangle->area(); // Output: 16. But it should be 20 for a rectangle
```

4. **Interface Segregation Principle (ISP)**

Not following ISP:
  
```php
        interface IItem
        {
            public function applyDiscount($discount);
            public function applyPromocode($promocode);

            public function setColor($color);
            public function setSize($size);

            public function setCondition($condition);
            public function setPrice($price);
        }
```

No following ISP:

```php
    interface IItem
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

    class Book implements IItem, IDiscountable
    {
        public function setCondition($condition){/*...*/}
        public function setPrice($price){/*...*/}
        public function applyDiscount($discount){/*...*/}
        public function applyPromocode($promocode){/*...*/}
    }

    class KidsClothes implements IItem, IClothes
    {
        public function setCondition($condition){/*...*/}
        public function setPrice($price){/*...*/}
        public function setColor($color){/*...*/}
        public function setSize($size){/*...*/}
        public function setMaterial($material){/*...*/}
    }
```

5. **Principle of Dependency Inversion:**

Not following DIP:

```php
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
    }
```  
     
Following Interface segregation:

```php
class Customer
      {
          private $currentOrder = null;

          public function buyItems(IOrderProcessor $processor)
          {    
              if(is_null($this->currentOrder)){
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
      }
```
