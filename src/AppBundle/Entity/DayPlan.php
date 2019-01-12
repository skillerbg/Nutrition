<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DayPlan
 *
 * @ORM\Table(name="day_plan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DayPlanRepository")
 */
class DayPlan
{
    /**
     * @var int
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\WeekPlan")

     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var recipe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe", inversedBy="id")
     * @ORM\JoinColumn(name="breakfast", referencedColumnName="id")
     */
    private $breakfast;

    /**
     * @var recipe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe", inversedBy="id")
     * @ORM\JoinColumn(name="snack1", referencedColumnName="id")
     */
    private $snack1;

    /**
     * @var recipe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe", inversedBy="id")
     * @ORM\JoinColumn(name="dinner1", referencedColumnName="id")
     */
    private $dinner1;

    /**
     * @var recipe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe", inversedBy="id")
     * @ORM\JoinColumn(name="snack2", referencedColumnName="id")
     */
    private $snack2;

    /**
     * @var recipe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe", inversedBy="id")
     * @ORM\JoinColumn(name="dinner2", referencedColumnName="id")
     */
    private $dinner2;
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
     * Set breakfast.
     *
     * @param recipe $breakfast
     *
     * @return DayPlan
     */
    public function setBreakfast($breakfast)
    {
        $this->breakfast = $breakfast;

        return $this;
    }

    /**
     * Get breakfast.
     *
     * @return recipe
     */
    public function getBreakfast()
    {
        return $this->breakfast;
    }

    /**
     * Set snack1.
     *
     * @param recipe $snack1
     *
     * @return DayPlan
     */
    public function setSnack1($snack1)
    {
        $this->snack1 = $snack1;

        return $this;
    }

    /**
     * Get snack1.
     *
     * @return recipe
     */
    public function getSnack1()
    {
        return $this->snack1;
    }

    /**
     * Set dinner1.
     *
     * @param recipe $dinner1
     *
     * @return DayPlan
     */
    public function setDinner1($dinner1)
    {
        $this->dinner1 = $dinner1;

        return $this;
    }

    /**
     * Get dinner1.
     *
     * @return recipe
     */
    public function getDinner1()
    {
        return $this->dinner1;
    }

    /**
     * Set snack2.
     *
     * @param recipe $snack2
     *
     * @return DayPlan
     */
    public function setSnack2($snack2)
    {
        $this->snack2 = $snack2;

        return $this;
    }

    /**
     * Get snack2.
     *
     * @return recipe
     */
    public function getSnack2()
    {
        return $this->snack2;
    }

    /**
     * Set dinner2.
     *
     * @param recipe $dinner2
     *
     * @return DayPlan
     */
    public function setDinner2($dinner2)
    {
        $this->dinner2 = $dinner2;

        return $this;
    }

    /**
     * Get dinner2.
     *
     * @return recipe
     */
    public function getDinner2()
    {
        return $this->dinner2;
    }
}
