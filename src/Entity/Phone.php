<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Phone
 *
 * @ApiResource
 * @ORM\Entity
 */
class Phone
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=45)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=45)
     */
    private $brand;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=45)
     */
    private $serial;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description = "";

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $os = "";

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $screenSize = 0;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $screenWidth = 0;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $screenHeight = 0;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getSerial(): string
    {
        return $this->serial;
    }

    /**
     * @param string $serial
     */
    public function setSerial(string $serial)
    {
        $this->serial = $serial;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getOs(): string
    {
        return $this->os;
    }

    /**
     * @param string $os
     */
    public function setOs(string $os)
    {
        $this->os = $os;
    }

    /**
     * @return int
     */
    public function getScreenSize(): int
    {
        return $this->screenSize;
    }

    /**
     * @param int $screenSize
     */
    public function setScreenSize(int $screenSize)
    {
        $this->screenSize = $screenSize;
    }

    /**
     * @return int
     */
    public function getScreenWidth(): int
    {
        return $this->screenWidth;
    }

    /**
     * @param int $screenWidth
     */
    public function setScreenWidth(int $screenWidth)
    {
        $this->screenWidth = $screenWidth;
    }

    /**
     * @return int
     */
    public function getScreenHeight(): int
    {
        return $this->screenHeight;
    }

    /**
     * @param int $screenHeight
     */
    public function setScreenHeight(int $screenHeight)
    {
        $this->screenHeight = $screenHeight;
    }

}
