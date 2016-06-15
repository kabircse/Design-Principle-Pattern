<?php
/** New paypal class rename a method name, sendPayment to payAmount
  * for matching this incompatibility with my existing system, just I will use an adapter class
*/
class PayPal {
     
    public function __construct() {
        // Your Code here //
    }
     
    public function payAmount($amount) {
        // Paying via Paypal //
        echo "Paying via PayPal: ". $amount;
    }
}
 
 
class paypalAdapter{
     
    private $paypal;
 
    public function __construct(PayPal $paypal) {
        $this->paypal = $paypal;
    }
     
    public function pay($amount) {
        $this->paypal->payAmount($amount);
    }
}
// Client Code
$paypal = new paypalAdapter(new PayPal());
echo $paypal->pay('2629');