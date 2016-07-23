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
    $patternBook = new Book('Design Patterns', 'Kabir Hossain'); 
    $decorator = new BookTitleDecorator($patternBook);  
    echo $decorator->showTitle();
    
    //OutPut: Design Patterns
    
