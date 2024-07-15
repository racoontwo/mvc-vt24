<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Library;

class LibraryTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $library = new Library();

        $name = "Test Library";
        $library->setName($name);
        $this->assertEquals($name, $library->getName());

        $title = "Test Title";
        $library->setTitle($title);
        $this->assertEquals($title, $library->getTitle());

        $isbn = 1234567890;
        $library->setISBN($isbn);
        $this->assertEquals($isbn, $library->getISBN());

        $author = "Test Author";
        $library->setAuthor($author);
        $this->assertEquals($author, $library->getAuthor());


        $image = "test_image.jpg";
        $library->setImage($image);
        $this->assertEquals($image, $library->getImage());
    }

    public function testId()
    {
        $library = new Library();

        $this->assertNull($library->getId());
    }
}
