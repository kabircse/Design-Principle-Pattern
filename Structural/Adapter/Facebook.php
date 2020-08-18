<?php
// Old Facebook sdk library
class Facebook{
    public function post($msg)
    {
        // this will $msg to facebook
    }
} 
// Client code
$facebook = new Facebook;
$facebook->post("This is for demonstration");

// Imagine Facebook sdk updates post() method to postTowall()

//Updated Facebook sdk library
class Facebook{
    public function postToWall($msg)
    {
        // this will post a message into facebook wall
    }
}
 
interface socialMediaAdapter{
    public function post($msg);
}
 
class FacebookAdapter implements socialMediaAdapter{
    private $facebook;
    
    public function __construct(Facebook $facebook) {
        $this->facebook = $facebook;
    }
    
    public function post($msg) {
        $this->facebook->postToWall($msg);
    }
}
 
$facebook = new FacebookAdapter(new Facebook());
$facebook->post("Posting message...");
