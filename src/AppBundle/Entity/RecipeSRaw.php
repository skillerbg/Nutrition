<?php

namespace AppBundle\Entity;

use AppBundle\Form\RecipeType;
use Doctrine\ORM\Mapping as ORM;

/**
 * RecipeSRaw
 *
 * @ORM\Table(name="recipe_s_raw")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecipeSRawRepository")
 */
class RecipeSRaw
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
     * @var Raw
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Raw", inversedBy="id")
     * @ORM\JoinColumn(name="rawId", referencedColumnName="id")
     */
    private $rawId;

    /**
     * @var Recipe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe", inversedBy="id")
     * @ORM\JoinColumn(name="recipeId", referencedColumnName="id")
     */
    private $recipeId;

    /**
     * @return string
     */
    public function getQantity()
    {
        return $this->qantity;
    }

    /**
     * @param string $qantity
     */
    public function setQantity($qantity)
    {
        $this->qantity = $qantity;
    }

    /**
     * @var string
     * @ORM\Column(name="quantity", type="string")
     *

     */
    private $qantity;


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
     * Set rawId.
     *
     * @param Raw $rawId
     *
     * @return RecipeSRaw
     */
    public function setRawId($rawId)
    {
        $this->rawId = $rawId;

        return $this;
    }

    /**
     * Get rawId.
     *
     * @return Raw
     */
    public function getRawId()
    {
        return $this->rawId;
    }

    /**
     * Set recipeId.
     *
     * @param Recipe $recipeId
     *
     * @return RecipeSRaw
     */
    public function setRecipeId($recipeId)
    {
        $this->recipeId = $recipeId;

        return $this;
    }

    /**
     * Get recipeId.
     *
     * @return Recipe
     */
    public function getRecipeId()
    {
        return $this->recipeId;
    }
}
