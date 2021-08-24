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
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @var date
     * @ORM\Column(type="date")
     */
    private $published_at;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $published_by;

    /**
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return object
     */
    public function getPublished_at(): ?object
    {
        return $this->published_at;
    }

    /**
     * @param string $published_at
     * @return $this
     */
    public function setPublished_at(string $published_at): self
    {
        $this->published_at = $published_at;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPublished_by(): ?string
    {
        return $this->published_by;
    }

    /**
     * @param string $published_by
     * @return $this
     */
    public function setPublished_by(string $published_by): self
    {
        $this->published_by = $published_by;

        return $this;
    }
}
