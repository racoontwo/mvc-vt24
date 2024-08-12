<?php

namespace App\Tests\Repository;

use App\Entity\Forestry;
use App\Repository\ForestryRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class ForestryRepositoryTest extends TestCase
{
    private $registry;
    private $entityManager;
    private $classMetadata;
    private $repository;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->classMetadata = $this->createMock(ClassMetadata::class);
        $this->registry = $this->createMock(ManagerRegistry::class);
        $this->registry->method('getManagerForClass')->willReturn($this->entityManager);
        $this->entityManager->method('getClassMetadata')->willReturn($this->classMetadata);

        $this->repository = new ForestryRepository($this->registry);
    }

    public function testConstruct(): void
    {
        $this->assertInstanceOf(ForestryRepository::class, $this->repository);
    }

}
