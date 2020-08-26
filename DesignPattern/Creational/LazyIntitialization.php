<?php
 class Fruit {
    private $type;
    private static $types = array();
    private function __construct($type) {
        $this->type = $type;
    }
    public static function getFruit($type) {
        // Lazy initialization takes place here
        if (!array_key_exists($type, self::$types)) {
          self::$types[$type] = new Fruit($type);
        }
        return self::$types[$type];
    }
    public static function printCurrentTypes() {
        echo 'Number of instances made: ' . count(self::$types) . "\n";
        foreach (array_keys(self::$types) as $key) {
            echo "$key\n";
        }
        echo "\n";
    }
 }
 
 Fruit::getFruit('Apple');
 Fruit::printCurrentTypes();
 Fruit::getFruit('Banana');
 Fruit::printCurrentTypes();
 Fruit::getFruit('Mango');
 Fruit::printCurrentTypes();?>
 
/*OUTPUT:
Number of instances made: 1
Apple
Number of instances made: 2
Apple
Banana
Number of instances made: 3
Apple
Banana
Mango
*/
