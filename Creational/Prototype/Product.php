<?php
interface product {
}
class Factory {
  private $product;
  public function __construct(Product $product) {
    $this->product = $product;
  }
  public function getProduct() {
    return clone $this->product;
  }
}

class SomeProduct implements Product {
  public $name;
}

$prototypeFactory = new Factory(new SomeProduct());
$firstProduct = $prototypeFactory->getProduct();
$firstProduct->name = 'This is first product.';

$secondProduct = $prototypeFactory->getProduct();
$secondProduct->name = 'This is second product.';

echo $firstProduct->name;
echo $secondProduct->name;
//Output:
//This is first product;
//This is second product;
