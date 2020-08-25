<?php
interface Factory {   // Creator
  public function getProduct();
}
interface Product {   // Product
  public function getName();
}
class FirstFactory implements Factory { // Concrete Creatpr
  public function getProduct() { // Factory Method
    return new FirstProduct();
  }
}
class FirstProduct implements Product { // Concrete Product
  public function getName() {
    return 'The first product';
  }
}

$factory = new FirstFactory(); // Concreate Creator
$firstProduct = $factory->getProduct(); // Factory Method
echo $firstProduct->getName(); // An operation

//There may other class as: SecondFactory,SecondProduct
