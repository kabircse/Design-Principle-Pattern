<?php
interface Lion
{
    public function roar();
}

class AfricanLion implements Lion
{
    public function roar()
    {
        echo 'Roar';
    }
}

class Hunter
{
    public function hunt(Lion $lion)
    {
        $lion->roar();
    }
}
// A dog needs to be added to the game
class WildDog
{
    public function bark()
    {
        echo 'Bark';
    }
}

// Adapter around wild dog to make it compatible with our game
class WildDogAdapter implements Lion
{
    protected $dog;

    public function __construct(WildDog $dog)
    {
        $this->dog = $dog;
    }

    public function roar()
    {
        $this->dog->bark();
    }
}

//Hunting Lion
echo "Hunting Lion: ";
$africanLion = new AfricanLion();
//$wildDogAdapter = new WildDogAdapter($wildDog);
$hunter = new Hunter();
echo $hunter->hunt($africanLion);

//Hunting Dog using Adapter pattern
echo "Hunting dog: ";
$wildDog = new WildDog();
$wildDogAdapter = new WildDogAdapter($wildDog);

$hunter = new Hunter();
echo $hunter->hunt($wildDogAdapter).'<br/>';
