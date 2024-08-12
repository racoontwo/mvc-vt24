<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Library;
use App\Repository\LibraryRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

class LibraryRepositoryTest extends TestCase
{
    private $entityManager;
    private $registry;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManager::class);
        $this->registry = $this->createMock(ManagerRegistry::class);
        $this->registry->method('getManagerForClass')->willReturn($this->entityManager);
    }

    public function testConstruct()
    {
        $libraryRepository = new LibraryRepository($this->registry);

        $this->assertInstanceOf(LibraryRepository::class, $libraryRepository);
    }
}
