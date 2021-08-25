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
     * @var \DateTime
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
    public function setName($name): self
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
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return object
     */
    public function getPublishedAt(): ?object
    {
        return $this->published_at;
    }

    /**
     * @param \DateTime $published_at
     * @return $this
     */
    public function setPublishedAt(\DateTime $published_at): self
    {
        $this->published_at = $published_at;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPublishedBy(): ?string
    {
        return $this->published_by;
    }

    /**
     * @param string $published_by
     * @return $this
     */
    public function setPublishedBy($published_by): self
    {
        $this->published_by = $published_by;

        return $this;
    }
}
