<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WeekPlan
 *
 * @ORM\Table(name="week_plan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WeekPlanRepository")
 */
class WeekPlan
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
     * @var DayPlan
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DayPlan", inversedBy="id")
     * @ORM\JoinColumn(name="monday", referencedColumnName="id")
     */
    private $monday;

    /**
     * @var DayPlan
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DayPlan", inversedBy="id")
     * @ORM\JoinColumn(name="tuesday", referencedColumnName="id")
     */
    private $tuesday;

    /**
     * @var DayPlan
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DayPlan", inversedBy="id")
     * @ORM\JoinColumn(name="wednesday", referencedColumnName="id")
     */
    private $wednesday;

    /**
     * @var DayPlan
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DayPlan", inversedBy="id")
     * @ORM\JoinColumn(name="thursday", referencedColumnName="id")
     */
    private $thursday;

    /**
     * @var DayPlan
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DayPlan", inversedBy="id")
     * @ORM\JoinColumn(name="friday", referencedColumnName="id")
     */
    private $friday;

    /**
     * @var DayPlan
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DayPlan", inversedBy="id")
     * @ORM\JoinColumn(name="saturday", referencedColumnName="id")
     */
    private $saturday;

    /**
     * @var DayPlan
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DayPlan", inversedBy="id")
     * @ORM\JoinColumn(name="sunday", referencedColumnName="id")
     */
    private $sunday;

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
     * Set userId.
     *
     * @param int $userId
     *
     * @return WeekPlan
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
     * Set monday.
     *
     * @param DayPlan $monday
     *
     * @return WeekPlan
     */
    public function setMonday($monday)
    {
        $this->monday = $monday;

        return $this;
    }

    /**
     * Get monday.
     *
     * @return DayPlan
     */
    public function getMonday()
    {
        return $this->monday;
    }

    /**
     * Set tuesday.
     *
     * @param DayPlan $tuesday
     *
     * @return WeekPlan
     */
    public function setTuesday($tuesday)
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    /**
     * Get tuesday.
     *
     * @return DayPlan
     */
    public function getTuesday()
    {
        return $this->tuesday;
    }

    /**
     * Set wednesday.
     *
     * @param DayPlan $wednesday
     *
     * @return WeekPlan
     */
    public function setWednesday($wednesday)
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    /**
     * Get wednesday.
     *
     * @return DayPlan
     */
    public function getWednesday()
    {
        return $this->wednesday;
    }

    /**
     * Set thusday.
     *
     * @param DayPlan $thursday
     *
     * @return WeekPlan
     */
    public function setThursday($thursday)
    {
        $this->thursday = $thursday;

        return $this;
    }

    /**
     * Get thusday.
     *
     * @return DayPlan
     */
    public function getThursday()
    {
        return $this->thursday;
    }

    /**
     * Set friday.
     *
     * @param DayPlan $friday
     *
     * @return WeekPlan
     */
    public function setFriday($friday)
    {
        $this->friday = $friday;

        return $this;
    }

    /**
     * Get friday.
     *
     * @return DayPlan
     */
    public function getFriday()
    {
        return $this->friday;
    }

    /**
     * Set saturday.
     *
     * @param DayPlan $saturday
     *
     * @return WeekPlan
     */
    public function setSaturday($saturday)
    {
        $this->saturday = $saturday;

        return $this;
    }

    /**
     * Get saturday.
     *
     * @return DayPlan
     */
    public function getSaturday()
    {
        return $this->saturday;
    }

    /**
     * Set sunday.
     *
     * @param DayPlan $sunday
     *
     * @return WeekPlan
     */
    public function setSunday($sunday)
    {
        $this->sunday = $sunday;

        return $this;
    }

    /**
     * Get sunday.
     *
     * @return DayPlan
     */
    public function getSunday()
    {
        return $this->sunday;
    }
}
