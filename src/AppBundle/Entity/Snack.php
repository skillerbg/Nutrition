<?php




namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Snack
 *
 * @ORM\Table(name="snack")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SnackRepository")
 */
class Snack
{
    /**
     * @var int
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DayPlan")
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
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
     * @ORM\Column(name="unSaturatedFats", type="decimal", precision=20, scale=10)
     */
    private $unSaturatedFats;

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
     * @ORM\Column(name="unSaturatedFatsPerG", type="decimal", precision=20, scale=10)
     */
    private $unSaturatedFatsPerG;

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
     * Snack constructor.

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
     * @return Snack
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
     * @return Snack
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
     * @return Snack
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
     * @return Snack
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
     * @return Snack
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
     * @return Snack
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
     * @return Snack
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
     * @return Snack
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
     * Set unSaturatedFats.
     *
     * @param string $unSaturatedFats
     *
     * @return Snack
     */
    public function setUnSaturatedFats($unSaturatedFats)
    {
        $this->unSaturatedFats = $unSaturatedFats;
        $this->setUnSaturatedFatsPerG();

        return $this;
    }

    /**
     * Get unSaturatedFats.
     *
     * @return string
     */
    public function getUnSaturatedFats()
    {
        return $this->unSaturatedFats;
    }

    /**
     * Set proteins.
     *
     * @param string $proteins
     *
     * @return Snack
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
     * @return Snack
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
     * @return Snack
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
     * Set unSaturatedFatsPerG.
     *
     *
     */
    public function setUnSaturatedFatsPerG()
    {
        $this->unSaturatedFatsPerG = $this->unSaturatedFats/100;

    }

    /**
     * Get unSaturatedFatsPerG.
     *
     * @return string
     */
    public function getUnSaturatedFatsPerG()
    {
        return $this->unSaturatedFatsPerG;
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
