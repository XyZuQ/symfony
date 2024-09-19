<?php
/**
 *  Contact Entity
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */
namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Contact.
 */
#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $firstName = null;
    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $lastName = null;
    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $email = null;
    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $phone = null;
    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $street = null;
    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $postCode = null;
    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $city = null;

    /**
     * Gets the ID of the contact.
     *
     * @return int|null The contact ID
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Gets the first name of the contact.
     *
     * @return string|null The first name
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Gets the last name of the contact.
     *
     * @return string|null The last name
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Gets the email address of the contact.
     *
     * @return string|null The email address
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the phone number of the contact.
     *
     * @return string|null The phone number
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Gets the street address of the contact.
     *
     * @return string|null The street address
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string $street
     *
     * @return $this
     */
    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Gets the postal code of the contact.
     *
     * @return string|null The postal code
     */
    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    /**
     * @param string $postCode
     *
     * @return $this
     */
    public function setPostCode(string $postCode): static
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Gets the city of the contact.
     *
     * @return string|null The city
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return $this
     */
    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }
}
