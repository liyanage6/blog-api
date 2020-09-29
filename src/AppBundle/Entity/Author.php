<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Author
 * @package AppBundle\Entity
 * @ORM\Entity()
 * @ORM\Table()
 */
class Author
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column
     */
    private $fullname;

    /**
     * @ORM\Column(type="text")
     */
    private $biography;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Article", mappedBy="author", cascade={"persist"})
     */
    private $articles;

    public function __construct ()
    {
        $this->articles = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId ($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFullname ()
    {
        return $this->fullname;
    }

    /**
     * @param mixed $fullname
     */
    public function setFullname ($fullname)
    {
        $this->fullname = $fullname;
    }

    /**
     * @return mixed
     */
    public function getBiography ()
    {
        return $this->biography;
    }

    /**
     * @param mixed $biography
     */
    public function setBiography ($biography)
    {
        $this->biography = $biography;
    }

    /**
     * @return mixed
     */
    public function getArticles ()
    {
        return $this->articles;
    }

    /**
     * @param mixed $articles
     */
    public function setArticles ($articles)
    {
        $this->articles = $articles;
    }


}