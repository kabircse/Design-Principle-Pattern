<?php
class OrderContext
{
    private State $state;
    public static function create(): OrderContext
    {
        $order = new self();
        $order->state = new StateCreated();
        return $order;
    }

    public function setState(State $state)
    {
        $this->state = $state;
    }

    public function proceedToNext()
    {
        $this->state->proceedToNext($this);
    }

    public function toString()
    {
        return $this->state->toString();
    }
}
interface State
{
    public function proceedToNext(OrderContext $context);
    public function toString(): string;
}
class StateCreated implements State
{
    public function proceedToNext(OrderContext $context)
    {
        $context->setState(new StateShipped());
    }

    public function toString(): string
    {
        return 'created';
    }
}
class StateShipped implements State
{
    public function proceedToNext(OrderContext $context)
    {
        $context->setState(new StateDone());
    }

    public function toString(): string
    {
        return 'shipped';
    }
}
class StateDone implements State
{
    public function proceedToNext(OrderContext $context)
    {
        // there is nothing more to do
    }

    public function toString(): string
    {
        return 'done';
    }
}
$orderContext = OrderContext::create();
$orderContext->toString() // created

$contextOrder = OrderContext::create();
$contextOrder->proceedToNext();
$contextOrder->toString() // shipped

$contextOrder = OrderContext::create();
$contextOrder->proceedToNext();
$contextOrder->proceedToNext();
$contextOrder->toString() // done;


$contextOrder = OrderContext::create();
$contextOrder->proceedToNext();
$contextOrder->proceedToNext();
$contextOrder->proceedToNext();
$contextOrder->toString()//done

