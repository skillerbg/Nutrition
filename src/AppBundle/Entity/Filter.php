<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filter
 *
 * @ORM\Table(name="filter")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FilterRepository")
 */
class Filter
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
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;


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
     * @return Filter
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
     * @return Filter
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
     * Set userId.
     *
     * @param int $userId
     *
     * @return Filter
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
}
