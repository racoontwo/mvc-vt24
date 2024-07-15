<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Book;

class BookTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $book = new Book();

        // Test setting and getting the title
        $title = "Test Title";
        $book->setTitle($title);
        $this->assertEquals($title, $book->getTitle());

        // Test setting and getting the ISBN
        $isbn = 1234567890;
        $book->setISBN($isbn);
        $this->assertEquals($isbn, $book->getISBN());

        // Test setting and getting the author
        $author = "Test Author";
        $book->setAuthor($author);
        $this->assertEquals($author, $book->getAuthor());

        // Test setting and getting the image
        $image = "test_image.jpg";
        $book->setImage($image);
        $this->assertEquals($image, $book->getImage());
    }

    public function testId()
    {
        $book = new Book();

        // The ID should be null initially since it's generated by the database
        $this->assertNull($book->getId());
    }
}