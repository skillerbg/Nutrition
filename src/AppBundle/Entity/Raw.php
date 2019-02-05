<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Raw
 *
 * @ORM\Table(name="raw")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RawRepository")
 */
class Raw
{
    /**
     * @var int
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Nutrition_Info", mappedBy="id")
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Recipe", mappedBy="raws")
     */
    private $recipes;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Nutrition_Info", inversedBy="id")
     * @ORM\JoinColumn(name="nutrition_info", referencedColumnName="id")
     */

    private $nutrition_info;



    /**
     * @return mixed
     */
    public function getRecipes()
    {
        return $this->recipes;
    }

    /**
     * @param mixed $recipes
     */
    public function setRecipes($recipes)
    {
        $this->recipes = $recipes;
    }

    /**
     * @return mixed
     */
    public function getNutritionInfo()
    {
        return $this->nutrition_info;
    }

    /**
     * @param mixed $nutrition_info
     */
    public function setNutritionInfo($nutrition_info)
    {
        $this->nutrition_info = $nutrition_info;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */

    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=4080)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="decimal", precision=20, scale=3)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="pricePerG", type="decimal", precision=20, scale=10)
     */
    private $pricePerG;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture;



    /**
     * @ORM\Column(name="vegan", type="boolean")
     */
    private $vegan = false;

    /**
     * @ORM\Column(name="vegetarian", type="boolean")
     */
    private $vegetarian = false;

    /**
     * @ORM\Column(name="glutenfree", type="boolean")
     */
    private $glutenfree = false;

    /**
     * @ORM\Column(name="organic", type="boolean")
     */
    private $organic = false;

    /**
     * @ORM\Column(name="lactosefree", type="boolean")
     */
    private $lactosefree = false;

    /**
     * @return mixed
     */
    public function getVegan()
    {
        return $this->vegan;
    }

    /**
     * @param mixed $vegan
     */
    public function setVegan($vegan)
    {
        $this->vegan = $vegan;
    }

    /**
     * @return mixed
     */
    public function getVegetarian()
    {
        return $this->vegetarian;
    }

    /**
     * @param mixed $vegetarian
     */
    public function setVegetarian($vegetarian)
    {
        $this->vegetarian = $vegetarian;
    }

    /**
     * @return mixed
     */
    public function getGlutenfree()
    {
        return $this->glutenfree;
    }

    /**
     * @param mixed $glutenfree
     */
    public function setGlutenfree($glutenfree)
    {
        $this->glutenfree = $glutenfree;
    }

    /**
     * @return mixed
     */
    public function getOrganic()
    {
        return $this->organic;
    }

    /**
     * @param mixed $organic
     */
    public function setOrganic($organic)
    {
        $this->organic = $organic;
    }

    /**
     * @return mixed
     */
    public function getLactosefree()
    {
        return $this->lactosefree;
    }

    /**
     * @param mixed $lactosefree
     */
    public function setLactosefree($lactosefree)
    {
        $this->lactosefree = $lactosefree;
    }



    /**
     * Raw constructor.

     */
    public function __construct()
    {
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Raw
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Raw
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price.
     *
     * @param string $price
     *
     * @return Raw
     */
    public function setPrice($price)
    {
        $this->price = $price;
        if ($this->quantity !== null){
            $this->setPricePerG();
        }

        return $this;
    }

    /**
     * Get price.
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set quantity.
     *
     * @param string $quantity
     *
     * @return Raw
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        if ($this->price !== null){
            $this->setPricePerG();
        }
        return $this;
    }

    /**
     * Get quantity.
     *
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set pricePerG.
     *
     *
     */
    public function setPricePerG()
    {
        $this->pricePerG = ($this->price/$this->quantity);

    }

    /**
     * Get pricePerG.
     *
     * @return string
     */
    public function getPricePerG()
    {
        return $this->pricePerG;
    }

    /**
     * Set picture.
     *
     * @param string $picture
     *
     * @return Raw
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture.
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set kcal.
     *
     * @param string $kcal
     *
     * @return Raw
     */
}
