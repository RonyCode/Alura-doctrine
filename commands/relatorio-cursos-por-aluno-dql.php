<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Entity\Curso;
use Alura\Doctrine\Helper\EntityManagerFactory;
use Doctrine\DBAL\Logging\DebugStack;

require_once __DIR__ . '../../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();
$alunosRepository = $entityManager->getRepository(Aluno::class);

$debugStack = new DebugStack();
$entityManager->getConfiguration()->setSQLLogger($debugStack);

$classAluno = Aluno::class;
$dql = "SELECT aluno, telefones, cursos FROM $classAluno aluno JOIN aluno.telefones telefones JOIN aluno.cursos cursos";

$query = $entityManager->createQuery($dql);

/**
 * @var Aluno[] $alunos
 */
$alunos = $query->getResult();

foreach ($alunos as $aluno) {
    $telefones = $aluno
        ->getTelefones()
        ->map(function (Telefone $telefone) {
            return $telefone->getNumero();
        })
        ->toArray();

    echo "ID: {$aluno->getId()},\n";
    echo "Nome: {$aluno->getName()}\n";
    echo "Telefone: " . implode(",", $telefones);
    echo "\n\n";

    /**
     * @var Curso[] $cursos
     */
    $cursos = $aluno->getCursos();
    foreach ($cursos as $curso) {
        echo "ID Curso: {$curso->getId()}\n";
        echo "\tCurso:{$curso->getName()}";
        echo "\n";
    }
    echo '\n';
    foreach ($debugStack->queries as $queryInfo) {
        echo $queryInfo['sql'] . "\n";
    }
}

print_r($debugStack);
