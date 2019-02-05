<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recipe_Nutrion
 *
 * @ORM\Table(name="recipe_Nutrion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Recipe_NutrionRepository")
 */
class Recipe_Nutrion
{
    /**
     * @var int
     * @ORM\ManyToOne( inversedBy="recipe_Nutrion" ,cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;









    /**
     * @var string
     *
     * @ORM\Column(name="kcal", type="decimal", precision=20, scale=10)
     */
    private $kcal;

    /**
     * @var string
     *
     * @ORM\Column(name="fats", type="decimal", precision=20, scale=10)
     */
    private $fats;

    /**
     * @var string
     *
     * @ORM\Column(name="saturatedFats", type="decimal", precision=20, scale=10)
     */
    private $saturatedFats;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="decimal", precision=20, scale=10)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="proteins", type="decimal", precision=20, scale=10)
     */
    private $proteins;

    /**
     * @var string
     *
     * @ORM\Column(name="carbs", type="decimal", precision=20, scale=10)
     */
    private $carbs;

    /**
     * @var string
     *
     * @ORM\Column(name="sugars", type="decimal", precision=20, scale=10)
     */
    private $sugars;



    /**
     * Recipe_Nutrion constructor.
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
     * Set kcal.
     *
     * @param string $kcal
     *
     * @return Recipe_Nutrion
     */
    public function setKcal($kcal)
    {
        $this->kcal = $kcal;

        return $this;
    }

    /**
     * Get kcal.
     *
     * @return string
     */
    public function getKcal()
    {
        return $this->kcal;
    }

    /**
     * Set fats.
     *
     * @param string $fats
     *
     * @return Recipe_Nutrion
     */
    public function setFats($fats)
    {
        $this->fats = $fats;

        return $this;
    }

    /**
     * Get fats.
     *
     * @return string
     */
    public function getFats()
    {
        return $this->fats;
    }

    /**
     * Set saturatedFats.
     *
     * @param string $saturatedFats
     *
     * @return Recipe_Nutrion
     */
    public function setSaturatedFats($saturatedFats)
    {
        $this->saturatedFats = $saturatedFats;

        return $this;
    }

    /**
     * Get saturatedFats.
     *
     * @return string
     */
    public function getSaturatedFats()
    {
        return $this->saturatedFats;
    }

    /**
     * Set salt.
     *
     * @param string $salt
     *
     * @return Recipe_Nutrion
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt.
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set proteins.
     *
     * @param string $proteins
     *
     * @return Recipe_Nutrion
     */
    public function setProteins($proteins)
    {
        $this->proteins = $proteins;

        return $this;
    }

    /**
     * Get proteins.
     *
     * @return string
     */
    public function getProteins()
    {
        return $this->proteins;
    }

    /**
     * Set carbs.
     *
     * @param string $carbs
     *
     * @return Recipe_Nutrion
     */
    public function setCarbs($carbs)
    {
        $this->carbs = $carbs;

        return $this;
    }

    /**
     * Get carbs.
     *
     * @return string
     */
    public function getCarbs()
    {
        return $this->carbs;
    }

    /**
     * Set sugars.
     *
     * @param string $sugars
     *
     * @return Recipe_Nutrion
     */
    public function setSugars($sugars)
    {
        $this->sugars = $sugars;

        return $this;
    }

    /**
     * Get sugars.
     *
     * @return string
     */
    public function getSugars()
    {
        return $this->sugars;
    }


}
