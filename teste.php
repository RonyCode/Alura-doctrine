<?php

use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '/vendor/autoload.php';

$pdo = new PDO('mysql:localhost; dbname=doctrine', 'root', '170286para');

$entityManagerFactory = new EntityManagerFactory();
$entityManagerFactory = $entityManagerFactory->getEntityManager();

var_dump($entityManagerFactory->getConnection());
