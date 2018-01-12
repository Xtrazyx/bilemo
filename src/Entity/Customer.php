<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Customer
 *
 * @ApiResource(
 *     collectionOperations={
 *         "special" = { "route_name" = "post_customer", "access_control" = "is_granted('ROLE_COMPANY')" }
 *     },
 *     itemOperations={
 *         "get" = { "method" = "GET", "access_control" = "is_granted('ROLE_COMPANY') and object.company == user" },
 *         "delete" = { "method" = "DELETE", "access_control" = "is_granted('ROLE_COMPANY') and object.company == user" },
 *         "put" = { "method" = "PUT", "access_control" = "is_granted('ROLE_COMPANY') and object.company == user" }
 *     },
 *     attributes = { "normalization_context" = { "groups" = { "customer" } } }
 * )
 *
 * @ORM\Entity
 */
class Customer
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"customer"})
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=45)
     * @Groups({"customer"})
     */
    private $firstName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=45)
     * @Groups({"customer"})
     */
    private $lastName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=45)
     * @Groups({"customer"})
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Groups({"customer"})
     */
    private $phoneNumber = "";

    /**
     * @var Company $company
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="customers")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    public $company;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
        $company->addCustomer($this);
    }

}
