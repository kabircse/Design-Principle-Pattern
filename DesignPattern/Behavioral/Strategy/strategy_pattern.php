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

