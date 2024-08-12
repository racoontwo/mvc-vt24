<?php

namespace App\Tests\Repository;

use App\Entity\Redlisted;
use App\Repository\RedlistedRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;

class RedlistedRepositoryTest extends TestCase
{
    private $entityManager;
    private $registry;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->registry = $this->createMock(ManagerRegistry::class);

        $classMetadata = $this->createMock(ClassMetadata::class);
        $classMetadata->method('getName')->willReturn(Redlisted::class);

        $this->entityManager
            ->method('getClassMetadata')
            ->willReturn($classMetadata);

        $this->registry
            ->method('getManagerForClass')
            ->willReturn($this->entityManager);
    }

    public function testConstruct()
    {
        $repository = new RedlistedRepository($this->registry);

        $this->assertInstanceOf(RedlistedRepository::class, $repository);
    }
}
