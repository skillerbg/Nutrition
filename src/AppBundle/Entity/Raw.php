<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Raw
 *
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TestRepository")
 */
class Raw
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
     * @var RecipeSRaw
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RecipeSRaw", mappedBy="rawId")
     */
    private $recipe;


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
     * Set recipe.
     *
     * @param RecipeSRaw $recipe
     *
     * @return Raw
     */
    public function setRecipe($recipe)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Get recipe.
     *
     * @return RecipeSRaw
     */
    public function getRecipe()
    {
        return $this->recipe;
    }
}
