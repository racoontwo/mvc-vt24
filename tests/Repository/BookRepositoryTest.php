<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ManagerRegistry;


class BookRepositoryTest extends TestCase
{
    private $entityManager;
    private $bookRepository;
    private $registry;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManager::class);
        $this->registry = $this->createMock(ManagerRegistry::class);
        $this->registry->method('getManagerForClass')->willReturn($this->entityManager);

        $this->bookRepository = new BookRepository($this->registry);
    }

    public function testConstruct()
    {
        $bookRepository = new BookRepository($this->registry);
        $this->assertInstanceOf(BookRepository::class, $bookRepository);
    }

    // public function testFindByISBN()
    // {
    //     $isbn = 1234567890;
    //     $expectedResult = [
    //         [
    //             'id' => 1,
    //             'title' => 'Test Title',
    //             'ISBN' => $isbn,
    //             'author' => 'Test Author',
    //             'image' => 'test_image.jpg',
    //         ]
    //     ];


    //     $connection = $this->createMock(\Doctrine\DBAL\Connection::class);
    //     $this->entityManager->method('getConnection')->willReturn($connection);

    //     $statement = $this->createMock(\Doctrine\DBAL\Statement::class);
    //     $statement->method('fetchAllAssociative')->willReturn($expectedResult);

    //     $connection->method('executeQuery')->willReturn($statement);

    //     $result = $this->bookRepository->findByISBN($isbn);
    //     $this->assertEquals($expectedResult, $result);
    // }

    

    // public function testUpdateBook()
    // {
    //     $bookData = [
    //         'book_id' => 1,
    //         'title' => 'Updated Title',
    //         'isbn' => 1234567890,
    //         'author' => 'Updated Author',
    //         'image_url' => 'updated_image.jpg',
    //     ];

    //     $book = $this->createMock(Book::class);
    //     $book->method('getId')->willReturn($bookData['book_id']);
    //     $book->expects($this->once())->method('setTitle')->with($bookData['title']);
    //     $book->expects($this->once())->method('setISBN')->with($bookData['isbn']);
    //     $book->expects($this->once())->method('setAuthor')->with($bookData['author']);
    //     $book->expects($this->once())->method('setImage')->with($bookData['image_url']);

    //     $repository = $this->createMock(EntityRepository::class);
    //     $repository->method('find')->willReturn($book);

    //     $this->entityManager->method('getRepository')->willReturn($repository);
    //     $this->entityManager->expects($this->once())->method('flush');

    //     $this->bookRepository->updateBook($bookData);
    // }
}
