<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity
* @ORM\Table(name="address")
*/
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="street")
     * @Assert\NotBlank()
     */
    private $street;

    /**
     * @ORM\Column(type="string", name="city")
     * @Assert\NotBlank()
     */
    private $city;

    /**
     * @ORM\Column(type="string", name="postal_code")
     * @Assert\NotBlank()
     */
    private $postalCode;

    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="addresses")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    private $member;

    public function getId()
    {
        return $this->id;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    public function setMember($member)
    {
        $this->member = $member;
    }
}
