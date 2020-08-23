<?php
class Config {
  public static $factory = 1;  
}
interface Product {
  public function getName();
}

abstract class AbstractFactory {
  public static function getFactory() {
    switch(Config::$factory) {
      case 1:
        return new FirstFactory();
      case 2: 
        return new SecondFactory();
    }
    throw new Exception('Bad config');
  }
  abstract public function getProduct();
}

class FirstFactory extends AbstractFactory {
  public function getProduct() {
    return new FirstProduct();
  }
}

class FirstProduct implements Product {
  public function getName() {
    return 'The product form the first factory';
  }
}

$firstFactory = AbstractFactory::getFactory();
$firstProduct = $firstFactory->getProduct();
echo $firstProduct->getName();
//Output:
// The first product form the first factory

Config::$factory = 2;
$secondFactory = AbstractFactory::getFactory();
$secondProduct = $secondFactory->getProduct();
echo $secondProduct->getName();
//Output:
//The second prodcut from the second factory
