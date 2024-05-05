<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class LibraryController extends AbstractController
{
    #[Route('/library', name: 'app_library')]
    public function index(): Response
    {
        return $this->render('library/index.html.twig', [
            'route_name' => 'Library',
        ]);
    }

    #[Route('/library/create', name: 'library_create')]
    public function createProduct(
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();

        $title = 'Notes from Underground';
        $isbn = 9780802845702;
        $author = 'Fyodor Dostoyevsky';
        $image = 'https://s1.adlibris.com/images/8418385/notes-from-underground.jpg';


        // $book = new Book();
        // $book->setTitle('Lila');
        // $book->setISBN(9781846881541);
        // $book->setAuthor('Robert M. Pirsig');
        // $book->setImage('https://s1.adlibris.com/images/5027537/lila.jpg');

        // $book = new Book();
        // $book->setTitle('The Stranger');
        // $book->setISBN(9780679720201);
        // $book->setAuthor('Albert Camus');
        // $book->setImage('https://s1.adlibris.com/images/935640/the-stranger.jpg');

        $book = new Book();
        $book->setTitle($title);
        $book->setISBN($isbn);
        $book->setAuthor($author);
        $book->setImage($image);

        // tell Doctrine you want to (eventually) save the book
        // (no queries yet)
        $entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new book with id '.$book->getId());
    }

    #[Route('/library/add_form', name: 'library_add_form')]
    public function addBookForm(
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();

        return $this->render('library/add.html.twig', [
            'route_name' => 'Add book',
        ]);
    }

    #[Route('/library/add', name: 'library_add', methods: ['POST'])]
    public function addBook(
        Request $request,
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = new Book();

        if ($request->isMethod('POST')) {
            // Retrieve data from the form
            $book->setTitle($request->request->get('title'));
            $book->setISBN($request->request->get('isbn'));
            $book->setAuthor($request->request->get('author'));
            $book->setImage($request->request->get('image_url'));
        }

        $this->addFlash('success', "The book '{$book->getTitle()}' was added successfully to the library");

        $entityManager->persist($book);
        $entityManager->flush();

        return $this->render('library/add.html.twig');
    }


    #[Route('/library/show', name: 'library_show_all')]
    public function showAllLibrary(
        BookRepository $BookRepository
    ): Response {
        $books = $BookRepository
            ->findAll();

        // return $this->json($products);
        $response = $this->json($books);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/library/show/{id}', name: 'library_by_id')]
    public function showBookById(
        BookRepository $bookRepository,
        int $id
    ): Response {
        $book = $bookRepository
            ->find($id);

        $data['book'] = $book;
        // return $this->json($book);
        return $this->render('library/view.one.html.twig', $data);
    }

    #[Route('/library/delete/{id}', name: 'library_delete_by_id')]
    public function deleteBookById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('library_show_all');
    }

    #[Route('/library/view', name: 'library_view_all')]
    public function viewAllBooks(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository->findAll();

        $data = [
            'books' => $books
        ];

        return $this->render('library/view.html.twig', $data);
    }

    #[Route('/library/update{id}', name: 'library_update')]
    public function updateBook(
        BookRepository $bookRepository,
        int $id
    ): Response {
        $book = $bookRepository
        // ->find(1);
        ->find($id);

        // echo($id);

        $data['book'] = $book;

        $data = [
            'book' => $book
        ];

        return $this->render('library/update.html.twig', $data);
    }
}
