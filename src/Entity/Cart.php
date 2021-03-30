<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $qlt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQlt(): ?int
    {
        return $this->qlt;
    }

    public function setQlt(int $qlt): self
    {
        $this->qlt = $qlt;

        return $this;
    }
}
