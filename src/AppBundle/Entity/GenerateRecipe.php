<?php

namespace AppBundle\Entity;

use AppBundle\AppBundle;
use Doctrine\ORM\Mapping as ORM;

/**
 * GenerateRecipe
 *
 * @ORM\Table(name="generate_recipe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenerateRecipeRepository")
 */
class GenerateRecipe
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
     * @var int
     *
     * @ORM\Column(name="UserId", type="integer")
     */
    private $userId;

    /**
     * @var Recipe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe", inversedBy="id")
     * @ORM\JoinColumn(name="recipeId", referencedColumnName="id")
     */
    private $recipeId;


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
     * Set userId.
     *
     * @param int $userId
     *
     * @return GenerateRecipe
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set recipeId.
     *
     * @param Recipe $recipeId
     *
     * @return GenerateRecipe
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
