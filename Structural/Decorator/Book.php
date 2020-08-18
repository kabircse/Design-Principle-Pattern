<?php

class Book {
    private $author;
    private $title;
    function __construct($title_in, $author_in) {
        $this->author = $author_in;
        $this->title  = $title_in;
    }
    function getAuthor() {
        return $this->author;
    }
    function getTitle() {
        return $this->title;
    }
    function getAuthorAndTitle() {
      return $this->getTitle().' by '.$this->getAuthor();
    }
}

class BookTitleDecorator {
    protected $book;
    protected $title;
    public function __construct(Book $book_in) {
        $this->book = $book_in;
        $this->resetTitle();
    }   
    //doing this so original object is not altered
    function resetTitle() {
        $this->title = $this->book->getTitle();
    }
    function showTitle() {
        return $this->title;
    }
}

class BookTitleStarDecorator extends BookTitleDecorator {
    private $btd;
    public function __construct(BookTitleDecorator $btd_in) {
        $this->btd = $btd_in;
    }
    function starTitle() {
        $this->btd->title = Str_replace(" "," * ",$this->btd->title);
    }
}

  $patternBook = new Book('Design Patterns','Kabir Hossain'); 
  $decorator = new BookTitleDecorator($patternBook);
  $starDecorator = new BookTitleStarDecorator($decorator);
 
  writeln('Showing title : ');
  writeln($decorator->showTitle());
  writeln('');
 
  writeln('Showing title after star added : ');
  $starDecorator->starTitle();
  writeln($decorator->showTitle());
  writeln(''); 


  function writeln($line_in) {
    echo $line_in."<br/>";
  }

/*
    Showing title : 
        Design Patterns
    
    Showing title after star added : 
        Design * Patterns
*/
