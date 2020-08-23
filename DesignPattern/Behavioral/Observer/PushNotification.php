<?php 
class Subject
{
    private $observers;
    private $state; 
    public function getState()
    {
        return $this->state;
    } 
    public function setState($state)
    {
        $this->state = $state; 
        $this->notify();
    } 
    public function attach(\AbstractObserver $observer)
    {
        $this->observers[spl_object_hash($observer)] = $observer;
    } 
    public function detach(\AbstractObserver $observer)
    {
        $id = spl_object_hash($observer); 
        unset($this->observers[$id]);
    } 
    public function notify()
    {
        foreach($this->observers as $id => $observer) {
            $observer->update();
        }
    }
}
abstract class AbstractObserver
{
    protected $subject; 
    public function __construct(\Subject $subject)
    {
        $this->subject = $subject; 
        $this->subject->attach($this);
    } 
    abstract public function update();
}
class EmailObserver extends AbstractObserver
{
    public function update()
    {
        // email sending code omitted for brevity 
        echo "<br/>Sending email notification with data: " . $this->subject->getState() . "<br/>";
    }
}
class SMSObserver extends AbstractObserver
{
    public function update()
    {
        // sms sending code omitted for brevity 
        echo "<br/>Sending sms notification with data: " . $this->subject->getState() . "<br/>";
    }
}
class PushNotificationObserver extends AbstractObserver
{
    public function update()
    {
        // push notification code omitted for brevity 
        echo "<br/>Sending push notification with data: " . $this->subject->getState() . "<br/>";
    }
}
class Client
{
    public function __construct()
    {
        $subject = new Subject();
        
        $emailObserver = new EmailObserver($subject);
        $smsObserver = new SMSObserver($subject);
        $pushObserver = new PushNotificationObserver($subject);
 
        echo "<h3>Starting observers</h3>";
        $subject->setState("my name: john smith");
 
        echo "<h3>Updating state</h3>";
        $subject->setState("my age: 30 years");
 
        echo "<h3>Detaching sms observer</h3>";
        $subject->detach($smsObserver);
        $subject->setState("my name: john smith");
    }
}
 
// run client
new \Client();
