<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity(repositoryClass="AppBundle\Repository\MemberRepository")
* @ORM\Table(name="member")
*/
class Member
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="first_name")
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", name="last_name")
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="member", cascade={"persist"})
     * @Assert\Valid
     */
    private $addresses;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getAddresses()
    {
        return $this->addresses;
    }

    public function addAddress(Address $address)
    {
        $address->setMember($this);
        $this->addresses->add($address);
    }

    public function removeAddress(Address $address)
    {
        $this->addresses->removeElement($address);
    }
}
