<?php
* Main interface
*/ 
interface INotification
{
    public function send($data);
}
 
/**
* Concrete class
*/
class DBNotification implements INotification
{
    public function send($data)
    {
        echo "Send notification to database: <strong>" . $data . "</strong><br/>";
    }
} 
$notification = new DBNotification();
$notification->send("Hello world");

/**
* Abstract Decorator
*/
abstract class NotificationDecorator implements INotification {
    protected $notifier; 
    public function __construct(INotification $notifier)
    {
        $this->notifier = $notifier;
    } 
    public function send($data)
    {
        $this->notifier->send($data);
    }
}

class EmailNotification extends NotificationDecorator {
   public function send($data)
   {
      echo "Send notification to email: <strong>" . $data . "</strong><br/>";
      $this->notifier->send($data);
   }
}
 
$notification = new DBNotification();
$notification = new EmailNotification($notification);
$notification->send("Hello world");

class SlackNotification extends NotificationDecorator {
   public function send($data)
   {
       echo "Send notification to slack: <strong>" . $data . "</strong><br/>";
      $this->notifier->send($data);
   }
}
 
class PushNotification extends NotificationDecorator {
   public function send($data)
   {
       echo "Send push notification: <strong>" . $data . "</strong><br/>";
      $this->notifier->send($data);
   }
}
 
$notification = new DBNotification();
$notification = new EmailNotification($notification);
$notification = new SlackNotification($notification);
$notification = new PushNotification($notification);
$notification->send("Hello world");
