<?php

namespace Alura\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 */
class Curso
{
    /**
     * @ID
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;
    /**
     *
     * @Column(type="string")
     */
    private $name;
    /**
     *
     * @ManyToMany(targetEntity= "Aluno", inversedBy="cursos")
     */
    private $alunos;

    public function __construct()
    {
        $this->alunos = new ArrayCollection();
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function addAluno(Aluno $aluno)
    {
        if ($this->alunos->contains($aluno)) {
            return $this;
        }
        $this->alunos->add($aluno);
        $aluno->addCurso($this);
        return $this;
    }

    public function getAlunos(): string
    {
        return $this->alunos;
    }
}
