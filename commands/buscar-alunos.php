<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '../../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$qdl =
    "SELECT aluno FROM Alura\\Doctrine\\Entity\Aluno aluno WHERE aluno.id =1 OR aluno.name ='Rony'";
$query = $entityManager->createQuery($qdl);
$alunoList = $query->getResult();

foreach ($alunoList as $aluno) {
    $telefones = $aluno
        ->getTelefones()
        ->map(function (Telefone $telefone) {
            return $telefone->getNumero();
        })
        ->toArray();

    echo "\nID = {$aluno->getId()}\nNome = {$aluno->getName()}";

    echo "\nTelefones : " . implode(',', $telefones);
}
