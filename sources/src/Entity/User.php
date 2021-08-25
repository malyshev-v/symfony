<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
     * @ORM\Column(type="string", length=45)
     */
    private $name;

    /**
     * @var integer
     * @ORM\Column(type="decimal", precision=5, scale=0)
     */
    private $age;

    /**
     * @var boolean
     * @ORM\Column(type="decimal", precision=1, scale=0)
     */
    private $sex;

    /**
     * @var integer
     * @ORM\Column(type="decimal", precision=1, scale=0)
     */
    private $role;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $password;

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
    public function getAge(): ?string
    {
        return $this->age;
    }

    /**
     * @param string $age
     * @return $this
     */
    public function setAge($age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSex(): ?string
    {
        return $this->sex;
    }

    /**
     * @param string $sex
     * @return $this
     */
    public function setSex($sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return $this
     */
    public function setRole($role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return $this
     */
    public function setLogin($login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }
}
