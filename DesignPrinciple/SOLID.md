SOLID principle:

- Single responsibility
- Open-closed
- Liskov substitution
- Interface segregation
- Dependency inversion

Example Program:
 <?php
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
   ?> 
    
    Single Responsibility:
     <?php
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
      ?> 
        
    Open-Closed Principle:
    Example Program:
     <?php
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
        ?> 
     Solution Program:   
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
        }
     ?> 

  The principle of interface separation (Interface segregation)
  Example program:
  
     <?php
        interface IItem
        {
            public function applyDiscount($discount);
            public function applyPromocode($promocode);

            public function setColor($color);
            public function setSize($size);

            public function setCondition($condition);
            public function setPrice($price);
        }
       ?> 
  Solution Program:
    <?php
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
   Principle of Dependency Inversion:
   Example Program:
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
    }
    ?>  
     
Solution:
    <?php
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
      ?> 
      
link: https://www.apphp.com/tutorials/index.php?page=solid-principles-in-php-examples
