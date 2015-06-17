<?php
// src/Acme/UserBundle/Entity/User.ph0p

namespace SupQuote\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->quotes = new ArrayCollection();

    }
    /**
     * @ORM\OneToMany(targetEntity="SupQuote\QuoteBundle\Entity\Quote", mappedBy="User")
     **/
    private $quotes;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add quotes
     *
     * @param \SupQuote\QuoteBundle\Entity\Quote $quotes
     * @return User
     */
    public function addQuote(\SupQuote\QuoteBundle\Entity\Quote $quotes)
    {
        $this->quotes[] = $quotes;

        return $this;
    }

    /**
     * Remove quotes
     *
     * @param \SupQuote\QuoteBundle\Entity\Quote $quotes
     */
    public function removeQuote(\SupQuote\QuoteBundle\Entity\Quote $quotes)
    {
        $this->quotes->removeElement($quotes);
    }

    /**
     * Get quotes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuotes()
    {
        return $this->quotes;
    }
}
