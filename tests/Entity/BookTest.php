<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Book;

class BookTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $book = new Book();

        $title = "Test Title";
        $book->setTitle($title);
        $this->assertEquals($title, $book->getTitle());

        $isbn = 1234567890;
        $book->setISBN($isbn);
        $this->assertEquals($isbn, $book->getISBN());

        $author = "Test Author";
        $book->setAuthor($author);
        $this->assertEquals($author, $book->getAuthor());

        $image = "test_image.jpg";
        $book->setImage($image);
        $this->assertEquals($image, $book->getImage());
    }

    public function testId()
    {
        $book = new Book();

        $this->assertNull($book->getId());
    }
}
