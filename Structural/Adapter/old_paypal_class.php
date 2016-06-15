<?php
// Concrete Implementation of PayPal Class
class PayPal {
     
    public function __construct() {
        // Your Code here //
    }
     
    public function sendPayment($amount) {
        // Paying via Paypal //
        echo "Paying via PayPal: ". $amount;
    }
}
 
class paypalAdapter {
     
    private $paypal;
 
    public function __construct(PayPal $paypal) {
        $this->paypal = $paypal;
    }
     
    public function pay($amount) {
        $this->paypal->sendPayment($amount);
    }
}
// Client Code
$paypal = new paypalAdapter(new PayPal());
echo $paypal->pay('2629');