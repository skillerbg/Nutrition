<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filters
 *
 * @ORM\Table(name="filters")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FiltersRepository")
 */
class Filters
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
     * @var string
     *
     * @ORM\Column(name="UserId", type="string", length=255)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="Kcal", type="string", length=255)
     */
    private $kcal;

    /**
     * @var string
     *
     * @ORM\Column(name="Budget", type="string", length=255)
     */
    private $budget;

    /**
     * @var string
     *
     * @ORM\Column(name="MacrosRatio", type="string", length=255,nullable=true)
     */
    private $macrosRatio;


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
     * @param string $userId
     *
     * @return Filters
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId.
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set kcal.
     *
     * @param string $kcal
     *
     * @return Filters
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
     * Set budget.
     *
     * @param string $budget
     *
     * @return Filters
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget.
     *
     * @return string
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set macrosRatio.
     *
     * @param string $macrosRatio
     *
     * @return Filters
     */
    public function setMacrosRatio($macrosRatio)
    {
        $this->macrosRatio = $macrosRatio;

        return $this;
    }

    /**
     * Get macrosRatio.
     *
     * @return string
     */
    public function getMacrosRatio()
    {
        return $this->macrosRatio;
    }
}
