<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotasRepository")
 */
class Notas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $idEmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaHora;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEmail(): ?string
    {
        return $this->idEmail;
    }

    public function setIdEmail(string $idEmail): self
    {
        $this->idEmail = $idEmail;

        return $this;
    }

    public function getNota(): ?string
    {
        return $this->nota;
    }

    public function setNota(?string $nota): self
    {
        $this->nota = $nota;

        return $this;
    }

    public function getFechaHora(): ?\DateTimeInterface
    {
        return $this->fechaHora;
    }

    public function setFechaHora(\DateTimeInterface $fechaHora): self
    {
        $this->fechaHora = $fechaHora;

        return $this;
    }
}
