abstract class AbstractChain
{
    private $next; 
    public function addNext(self $next): self
    {
        $this->next = $next; 
        return $next;
    } 
    public function handle(string $type): ?string
    {
        return $this->next ? $this->next->handle($type) : null;
    }
}
 
class BikeHandler extends AbstractChain
{
    public function handle(string $type): ?string
    {
        echo 'BikeHandler has run'.PHP_EOL; 
        if ($type === 'bike') {
            return $type;
        } 
        return parent::handle($type);
    }
}
 
class CarHandler extends AbstractChain
{
    public function handle(string $type): ?string
    {
        echo 'CarHandler has run'.PHP_EOL; 
        if ($type === 'car') {
            return $type;
        } 
        return parent::handle($type);
    }
}
 
class BusHandler extends AbstractChain
{
    public function handle(string $type): ?string
    {
        echo 'BusHandler has run'.PHP_EOL; 
        if ($type === 'bus') {
            return $type;
        } 
        return parent::handle($type);
    }
}

/ Client
$bikeHandler = new BikeHandler();
$carHandler = new CarHandler();
$busHandler = new BusHandler();
 
$bikeHandler->addNext($carHandler)->addNext($busHandler); 
echo $bikeHandler->handle('bike').PHP_EOL;
/*
// Output:
BikeHandler has run
bike 
*/
