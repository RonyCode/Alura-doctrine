<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '../../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$alunoRepository = $entityManager->getRepository(ALuno::class);
/**
 * @var Aluno[] $alunoList */
$alunoList = $alunoRepository->findALl();

foreach ($alunoList as $aluno) {
    echo "ID = {$aluno->getId()}\nNome = {$aluno->getName()}\n\n";
}
