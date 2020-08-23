<?php
interface Factory {
  public function getProduct();
}
interface Product {
  public function getName();
}
class FirstFactory implements Factory {
  public function getProduct() {
    return new FirstProduct();
  }
}
class FirstProduct implements Product {
  public function getName() {
    return 'The first product';
  }
}

$factory = new FirstFactory();
$firstProduct = $factory->getProduct();
echo $firstProduct->getName();
//There may other class as: SecondFactory,SecondProduct
