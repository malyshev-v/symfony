<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $published_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $published_by;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublishedAt(): ?string
    {
        return $this->published_at;
    }

    public function setPublishedAt(string $published_at): self
    {
        $this->published_at = $published_at;

        return $this;
    }

    public function getPublishedBy(): ?string
    {
        return $this->published_by;
    }

    public function setPublishedBy(string $published_by): self
    {
        $this->published_by = $published_by;

        return $this;
    }
}