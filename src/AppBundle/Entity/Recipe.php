<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Recipe
 *
 * @ORM\Table(name="recipes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecipeRepository")
 */
class Recipe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Raw", inversedBy="recipes")
     * @ORM\JoinTable(name="recipe_raws")
     */
    private $raws;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */

    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2000)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

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
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture;

    /**
     * @var array
     *
    @ORM\Column(name="array", type="array", nullable=true)
     */
    private $array;

    /**
     * @return array
     */
    public function getArray()
    {
        return $this->array;
    }

    /**
     *  Set array.
     *
     * @param array $array
     *
     * @return Recipe
     */
    public function setArray($array)
    {
        $this->array = $array;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name.
     *
     * @param string $type
     *
     * @return Recipe
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set name.
     *
     * @param string $price
     *
     * @return Recipe
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set name.
     *
     * @param string $quantity
     *
     * @return Recipe
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set name.
     *
     * @param string $picture
     *
     * @return Recipe
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe_Nutrion", inversedBy="id")
     * @ORM\JoinColumn(name="recipe_nutrition", referencedColumnName="id")
     */

    private $recipe_nutrition;

    /**
     * @return mixed
     */
    public function getRecipeNutrition()
    {
        return $this->recipe_nutrition;
    }

    /**
     * @param mixed $recipe_nutrition
     */
    public function setRecipeNutrition($recipe_nutrition)
    {
        $this->recipe_nutrition = $recipe_nutrition;
    }



    public function __construct()
    {
        $this->raws = new ArrayCollection();
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

    public function addRaw(Raw $raw)
    {
        $this->raws[] = $raw;

        return $this;
    }

    public function setRaws(ArrayCollection $raws)
    {
        $this->raws = $raws;

        return $this;
    }



    public function getRaws()
    {
        return $this->raws;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Recipe
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
     * @return Recipe
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
}
