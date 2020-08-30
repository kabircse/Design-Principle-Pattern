<?php
interface Observer { // observer
  function onChanged($sender, $args);
}
interface Observable { // subject
  function addObserver($observer);
}
class CustomerList implements Observable { // contreate subject
  private $_observers = array();
  public function addCustomer($name) {
    foreach($this->_observers as $obs)
      $obs->onChanged($this, $name);
  }
  public function addObserver($observer) {
    $this->_observers []= $observer;
  }
}
class CustomerListLogger implements Observer { // concreate observer
  public function onChanged($sender, $args) {
    echo( "'$args' Customer has been added to the list \n" );
  }
}
$ul = new CustomerList();
$ul->addObserver( new CustomerListLogger() );
$ul->addCustomer( "Jack" );
