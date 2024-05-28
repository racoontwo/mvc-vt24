<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * Find all books having with isbn.
     *
     * @param int $isbn input value with the value.
     *
     * @return mixed array of the book information.
     */
    public function findByISBN($isbn): mixed
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM book AS l
            WHERE l.ISBN = :isbn
        ';

        $resultSet = $conn->executeQuery($sql, ['isbn' => $isbn]);

        return $resultSet->fetchAllAssociative();
    }

    /**
     * Update book information based on the provided array.
     *
     * @param array $bookData Array containing book information.
     *
     * @return void
     */
    public function updateBook(array $bookData): void
    {
        $bookId = $bookData['book_id'];
        $title = $bookData['title'];
        $isbn = $bookData['isbn'];
        $author = $bookData['author'];
        $imageUrl = $bookData['image_url'];

        $entityManager = $this->getEntityManager();
        $book = $this->find($bookId);

        if ($book) {
            $book->setTitle($title);
            $book->setIsbn($isbn);
            $book->setAuthor($author);
            $book->setImage($imageUrl);

            $entityManager->flush();
        }
    }

    //    /**
    //     * @return Book[] Returns an array of Book objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Book
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
