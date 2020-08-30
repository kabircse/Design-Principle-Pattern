<?php
class Sheep
{
    protected $name;
    protected $category;
    public function __construct(string $name, string $category = 'Mountain Sheep')
    {
        $this->name = $name;
        $this->category = $category;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setCategory(string $category)
    {
        $this->category = $category;
    }
    public function getCategory()
    {
        return $this->category;
    }
}

$original = new Sheep('Jolly');
echo $original->getName(); // Jolly
echo $original->getCategory(); // Mountain Sheep

// Clone and modify what is required
$cloned = clone $original;
$cloned->setName('Dolly');
echo $cloned->getName(); // Dolly
echo $cloned->getCategory(); // Mountain sheep

// The magic method __clone can be used to modify the cloning behavior instead of clone keywords.