<?php
/** New paypal class rename a method name, sendPayment to payAmount
  * for matching this incompatibility with my existing system, just I will use an adapter class
*/
class PayPal {     
    public function __construct() {
        // Your Code here //
    }     
    public function payAmount($amount) {   // payAmount() -> pay().
        // Paying via Paypal //
        echo "Paying via PayPal: ". $amount;
    }
}

/* Now PayPal library changed payAmount() method to pay().
 But my large system uses previous payAmount() method, now I do not want to change the previous payAmount() method to my system.
 So, I used paypalAdapter to adapting new library.
 */ 
class paypalAdapter{     
    private $paypal; 
    public function __construct(PayPal $paypal) {
        $this->paypal = $paypal;
    }     
    public function payAmount($amount) {
        $this->paypal->pay($amount);
    }
}
// Client Code
$paypal = new paypalAdapter(new PayPal());
echo $paypal->payAmount('2629');
