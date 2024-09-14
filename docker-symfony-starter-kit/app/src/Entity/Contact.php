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

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $street = null;

    #[ORM\Column(length: 255)]
    private ?string $postCode = null;

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
     * Sets the first name of the contact.
     *
     * @param string $firstName The first name
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
     * Sets the last name of the contact.
     *
     * @param string $lastName The last name
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
     * Sets the email address of the contact.
     *
     * @param string $email The email address
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
     * Sets the phone number of the contact.
     *
     * @param string $phone The phone number
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
     * Sets the street address of the contact.
     *
     * @param string $street The street address
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
     * Sets the postal code of the contact.
     *
     * @param string $postCode The postal code
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
     * Sets the city of the contact.
     *
     * @param string $city The city
     */
    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }
}
