<?php

namespace SupQuote\QuoteBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Quote
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Quote
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\Length(
     *      min = "5",
     *      minMessage = "Le champ doit faire au moins {{ limit }} caractères",
     * )
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createAt", type="datetimetz")
     */
    private $createAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean")
     */
    private $published;

    function __construct($user)
    {
        $this->createAt = new \DateTime();
        $this->published = false;
        $this->user = $user;
    }


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
     * Set content
     *
     * @param string $content
     * @return Quote
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     * @return Quote
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime 
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Quote
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SupQuote\UserBundle\Entity\User", inversedBy="quotes")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $user;

    /**
     * Set user
     *
     * @param \SupQuote\UserBundle\Entity\User $user
     * @return Quote
     */
    public function setUser(\SupQuote\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \SupQuote\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
