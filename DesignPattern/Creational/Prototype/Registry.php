<?php
abstract class Item {  
  private $title;
  private $price;
  
  abstract function __clone();
  public function getTitle()
  {
    return $this->title;
  }
  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function getPrice()
  {
    return $this->price;
  }
  public function setPrice($price)
  {
    $this->price = $price;
  }
}

class Book extends Item {  
  private $numberOfPages;
  public function getNumberOfPages()
  {
    return $this->numberOfPages;
  }
  public function setNumberOfPages($numberOfPages)
  {
    $this->numberOfPages = $numberOfPages;
  }
}

class Movie extends Item {  
  private $runtime;
  public function getRuntime()
  {
    return $this->runtime;
  }
  public function setRuntime($runtime)
  {
    $this->runtime = $runtime;
  }
}

class Registry {  
  private $items;
  public function __construct()
  {
    $this->loadItems();
  }
  public function createItem($item)
  {
    $item = null;
    try {
      $item = $this->items->clone();
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    return $item;
  }

  public function loadItems() {
    $movie = new Movie();
    $movie->setTitle("Basic Movie");
    $movie->setPrice(24.99);
    $movie->setRuntime("2 Hours");
    $this->items[] = $movie;

    $book = new Book();
    $book->setNumberOfPages(335);
    $book->setPrice(24.99);
    $movie->setTitle("Basic Book");
    $this->items[] = $book;
  }
}
$registry = new Registry();
$movie = $registry->createItem("Movie");
$movie->setTitle("Creational Pattern in PHP");

echo $movie;  
echo $movie->getRuntime();  
echo $movie->getTitle();  

// $anotherMovie = $registry->createItem("Movie"); $anotherMovie->setTitle("Gang of Four");
