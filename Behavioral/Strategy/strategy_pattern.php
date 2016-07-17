<?php
/*
 *Imagine that you're currently developing a class which can either update or create a new user record.  It still needs the same inputs.
*/
//Ex:1
class User {     
    public function CreateOrUpdate($name, $address, $mobile, $userid = null)
    {
        if( is_null($userid) ) {
            new Create($parms);// it means the user doesn't exist yet, create a new record
        } else {
            new Update($parms);// it means the user already exists, just update based on the given userid
        }
    }
}

//Ex:2
class StrategyContext {
    private $strategy = NULL; 
    //bookList is not instantiated at construct time
    public function __construct($strategy_ind_id) {
        switch ($strategy_ind_id) {
            case "C": 
                $this->strategy = new StrategyCaps();
            break;
            case "E": 
                $this->strategy = new StrategyExclaim();
            break;
            case "S": 
                $this->strategy = new StrategyStars();
            break;
        }
    }
    public function showBookTitle($book) {
      return $this->strategy->showTitle($book);
    }
}

