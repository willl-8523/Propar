<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandRepository;

/**
 * @ORM\Entity(repositoryClass=App\Repository\CommandRepository::class)
 */
class Command
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(min=3, minMessage="Le nom doit faire 3 caracères minimum")
     */
    private $name_customer;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(min=3, minMessage="Le nom doit faire 3 caracères minimum")
     */
    private $prenom_customer;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email_customer;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $adress;
    
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $description;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCustomer(): ?string
    {
        return $this->name_customer;
    }

    public function setNameCustomer(string $name_customer): self
    {
        $this->name_customer = $name_customer;

        return $this;
    }

    public function getEmailCustomer(): ?string
    {
        return $this->email_customer;
    }

    public function setEmailCustomer(string $email_customer): self
    {
        $this->email_customer = $email_customer;

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

    public function getPrenomCustomer(): ?string
    {
        return $this->prenom_customer;
    }

    public function setPrenomCustomer(string $prenom_customer): self
    {
        $this->prenom_customer = $prenom_customer;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }
}
