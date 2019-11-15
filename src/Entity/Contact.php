<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank
     * @Assert\Choice({"Mr", "Mrs", "Ms"})
     */
    private $salutation;

    /**
     * @ORM\Column(type="string", length=1)
     * @Assert\NotBlank
     * @Assert\Choice({"M", "F"})
     */
    private $gender;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     * @Assert\Date
     */
    private $dob;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     * @Assert\Length(max=50)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     * @Assert\Length(max=50)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(max=50)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     * @Assert\Length(max=50)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=8)
     * @Assert\NotBlank
     * @Assert\Length(max=8)
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email
     * @Assert\Length(max=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(min=8, max=50)
     */
    private $password;

    /**
     * Create new instance from array.
     * 
     * @param array $data
     * @return Contact
     */
    public static function fromArray(array $data): Contact
    {
        return (new Contact())
                ->setSalutation($data['salutation'] ?? null)
                ->setGender($data['gender'] ?? null)
                ->setFirstName($data['firstName'] ?? null)
                ->setLastName($data['lastName'] ?? null)
                ->setAddress($data['address'] ?? null)
                ->setCity($data['city'] ?? null)
                ->setPostcode($data['postcode'] ?? null)
                ->setEmail($data['email'] ?? null)
                ->setPassword($data['password'] ?? null)
        ;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalutation(): ?string
    {
        return $this->salutation;
    }

    public function setSalutation(string $salutation): self
    {
        $this->salutation = $salutation;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(\DateTimeInterface $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }
}
