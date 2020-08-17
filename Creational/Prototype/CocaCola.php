<?php
class CocaCola {    
    private $healthy;
    private $tasty;

    public function __construct() {
        $this->healthy = false;
        $this->tasty   = true;
    }
 
    /**
     * This magic method is required, even if empty as part of the prototype pattern
     */
    public function __clone() { } 
}
 
$cola = new CocaCola();
var_dump($cola);
 
$colaClone = clone $cola;
var_dump($colaClone);
