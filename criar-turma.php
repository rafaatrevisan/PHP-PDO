<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($connection);

// definições da turma

$connection->beginTransaction();

try {
    $aStudent = new Student(null,
        'Chamber',
        new DateTimeImmutable('1992-10-26')
    );

    $studentRepository->save($aStudent);

    $anotherStudent = new Student(
        null,
        'Jett',
        new DateTimeImmutable('2002-07-14')
    );

    $studentRepository->save($anotherStudent);

    $connection->commit();
} catch (\PDOException $e){
    echo $e->getMessage();
    $connection->rollBack();
}

