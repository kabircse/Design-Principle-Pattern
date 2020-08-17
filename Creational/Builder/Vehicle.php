<?php
interface Builder
{
    public function createVehicle();
    public function addWheel();
    public function addEngine();
    public function getVehicle(): Vehicle;
}

class Director
{
    public function build(Builder $builder): Vehicle
    {
        $builder->createVehicle();
        $builder->addEngine();
        $builder->addWheel();

        return $builder->getVehicle();
    }
}

class TruckBuilder implements Builder
{
    private Truck $truck;
    public function addEngine()
    {
        $this->truck->setPart('truckEngine', new Engine());
    }
    public function addWheel()
    {
        $this->truck->setPart('wheel1', new Wheel());
        $this->truck->setPart('wheel2', new Wheel());
    }

    public function createVehicle()
    {
        $this->truck = new Truck();
    }

    public function getVehicle(): Vehicle
    {
        return $this->truck;
    }
}
class CarBuilder implements Builder
{
    private Car $car;
    public function addEngine()
    {
        $this->car->setPart('engine', new Engine());
    }
    public function addWheel()
    {
        $this->car->setPart('wheelLF', new Wheel());
        $this->car->setPart('wheelRF', new Wheel());
    }

    public function createVehicle()
    {
        $this->car = new Car();
    }

    public function getVehicle(): Vehicle
    {
        return $this->car;
    }
}
abstract class Vehicle
{
    /**
     * @var object[]
     */
    private array $data = [];

    public function setPart(string $key, object $value)
    {
        $this->data[$key] = $value;
    }
}
class Truck extends Vehicle
{
}
class Car extends Vehicle
{
}
class Engine
{
}
class Wheel
{
}

$truckBuilder = new TruckBuilder();
$newVehicle = (new Director())->build($truckBuilder);

$carBuilder = new CarBuilder();
$newVehicle = (new Director())->build($carBuilder);
