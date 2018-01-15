<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ArrayAccess;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Company
 *
 * @ApiResource(
 *     itemOperations={
 *         "get" = { "method" = "GET", "access_control" = "is_granted('ROLE_COMPANY') and object == user" }
 *     },
 *     attributes = { "normalization_context" = { "groups" = { "company" } } }
 * )
 *
 * @ORM\Entity
 */
class Company implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"company"})
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=45, unique=true)
     * @Groups({"company"})
     */
    private $username;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $password;

    /**
     * @var string
     *
     * @Assert\Email()
     * @ORM\Column(type="string", length=45)
     * @Groups({"company"})
     */
    private $email;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $roles = array('ROLE_COMPANY');

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Customer", mappedBy="company", cascade={"remove", "persist"})
     * @ApiSubresource
     * @Groups({"company"})
     */
    private $customers;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return ArrayAccess
     */
    public function getCustomers(): \ArrayAccess
    {
        return $this->customers;
    }

    /**
     * @param ArrayCollection $customers
     */
    public function setCustomers(ArrayCollection $customers)
    {
        $this->customers = $customers;
    }

    public function addCustomer(Customer $customer)
    {
        $this->customers->add($customer);
    }

    public function removeCustomer(Customer $customer)
    {
        $this->customers->remove($customer);
    }

    public function eraseCredentials()
    {
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles)
    {
        $this->roles[] = $roles;
    }

    public function getSalt()
    {
        return null;
    }
}
