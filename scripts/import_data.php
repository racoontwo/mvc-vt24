<?php

use App\Entity\Forestry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Dotenv\Dotenv;

// Bootstrap Symfony to access services
require dirname(__DIR__) . '/config/bootstrap.php';

$container = require dirname(__DIR__) . '/config/container.php';
$entityManager = $container->get(EntityManagerInterface::class);

// Path to your CSV file
$csvFile = dirname(__DIR__) . '/assets/example_data/test_data.csv';

// Call the import method
Forestry::importFromCSV($csvFile, $entityManager);
