<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nutrition_Info
 *
 * @ORM\Table(name="nutrition_info")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Nutrition_InfoRepository")
 */
class Nutrition_Info
{
    /**
     * @var int
     * @ORM\ManyToOne( inversedBy="nutrition_info" ,cascade={"persist"})
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
     * @var string
     *
     * @ORM\Column(name="kcalPerG", type="decimal", precision=20, scale=10)
     */
    private $kcalPerG;

    /**
     * @var string
     *
     * @ORM\Column(name="proteinsPerG", type="decimal", precision=20, scale=10)
     */
    private $proteinsPerG;

    /**
     * @var string
     *
     * @ORM\Column(name="fatsPerG", type="decimal", precision=20, scale=10)
     */
    private $fatsPerG;

    /**
     * @var string
     *
     * @ORM\Column(name="saturatedFatsPerG", type="decimal", precision=20, scale=10)
     */
    private $saturatedFatsPerG;

    /**
     * @var string
     *
     * @ORM\Column(name="saltPerG", type="decimal", precision=20, scale=10)
     */
    private $saltPerG;

    /**
     * @var string
     *
     * @ORM\Column(name="carbsPerG", type="decimal", precision=20, scale=10)
     */
    private $carbsPerG;

    /**
     * @var string
     *
     * @ORM\Column(name="sugarsPerG", type="decimal", precision=20, scale=10)
     */
    private $sugarsPerG;

    /**
     * Nutrition_Info constructor.
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
     * @return Nutrition_Info
     */
    public function setKcal($kcal)
    {
        $this->kcal = $kcal;
        $this->setKcalPerG();

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
     * @return Nutrition_Info
     */
    public function setFats($fats)
    {
        $this->fats = $fats;
        $this->setFatsPerG();

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
     * @return Nutrition_Info
     */
    public function setSaturatedFats($saturatedFats)
    {
        $this->saturatedFats = $saturatedFats;
        $this->setSaturatedFatsPerG();

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
     * @return Nutrition_Info
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
        $this->setSaltPerG();

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
     * @return Nutrition_Info
     */
    public function setProteins($proteins)
    {
        $this->proteins = $proteins;
        $this->setProteinsPerG();

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
     * @return Nutrition_Info
     */
    public function setCarbs($carbs)
    {
        $this->carbs = $carbs;
        $this->setCarbsPerG();

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
     * @return Nutrition_Info
     */
    public function setSugars($sugars)
    {
        $this->sugars = $sugars;
        $this->setSugarsPerG();

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

    /**
     * Set kcalPerG.
     *
     *
     */
    public function setKcalPerG()
    {
        $this->kcalPerG = $this->kcal/100;

    }

    /**
     * Get kcalPerG.
     *
     * @return string
     */
    public function getKcalPerG()
    {
        return $this->kcalPerG;
    }

    /**
     * Set proteinsPerG.
     *
     *
     */
    public function setProteinsPerG()
    {
        $this->proteinsPerG = $this->proteins/100;

    }

    /**
     * Get proteinsPerG.
     *
     * @return string
     */
    public function getProteinsPerG()
    {
        return $this->proteinsPerG;
    }

    /**
     * Set fatsPerG.
     *
     *
     */
    public function setFatsPerG()
    {
        $this->fatsPerG = $this->fats/100;

    }

    /**
     * Get fatsPerG.
     *
     * @return string
     */
    public function getFatsPerG()
    {
        return $this->fatsPerG;
    }

    /**
     * Set saturatedFatsPerG.
     *
     *
     */
    public function setSaturatedFatsPerG()
    {
        $this->saturatedFatsPerG = $this->saturatedFats/100;

    }

    /**
     * Get saturatedFatsPerG.
     *
     * @return string
     */
    public function getSaturatedFatsPerG()
    {
        return $this->saturatedFatsPerG;
    }

    /**
     * Set saltPerG.
     *
     *
     */
    public function setSaltPerG()
    {
        $this->saltPerG = $this->salt/100;

    }

    /**
     * Get saltPerG.
     *
     * @return string
     */
    public function getSaltPerG()
    {
        return $this->saltPerG;
    }

    /**
     * Set carbsPerG.
     *
     *
     */
    public function setCarbsPerG()
    {
        $this->carbsPerG = $this->carbs/100;

    }

    /**
     * Get carbsPerG.
     *
     * @return string
     */
    public function getCarbsPerG()
    {
        return $this->carbsPerG;
    }

    /**
     * Set sugarsPerG.
     *
     *
     */
    public function setSugarsPerG()
    {
        $this->sugarsPerG = $this->sugars/100;

    }

    /**
     * Get sugarsPerG.
     *
     * @return string
     */
    public function getSugarsPerG()
    {
        return $this->sugarsPerG;
    }
}
