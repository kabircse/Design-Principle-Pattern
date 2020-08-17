<?php
abstract class BookPrototype
{
    protected string $title;
    protected string $category;

    abstract public function __clone();

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}

class BanglaBookPrototype extends BookPrototype
{
    protected string $category = 'Bangla';

    public function __clone()
    {
    }
}

class EnglishBookPrototype extends BookPrototype
{
    protected string $category = 'English';

    public function __clone()
    {
    }
}

$banglaPrototype = new BanglaBookPrototype();
$englishPrototype = new EnglishBookPrototype();
    $book = clone $banglaPrototype;
    $book->setTitle('Bangla Book No 1');
            
    $book = clone $englishPrototype;
    $book->setTitle('English Book No 1');
     
