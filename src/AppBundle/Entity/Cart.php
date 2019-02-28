<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cart
 *
 * @ORM\Table(name="cart")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CartRepository")
 */
class Cart
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
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="grams", type="integer")
     */
    private $grams;

    /**
     * @return int
     */
    public function getGrams()
    {
        return $this->grams;
    }

    /**
     * @param int $grams
     */
    public function setGrams($grams)
    {
        $this->grams = $grams;
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
     * Set rawId.
     *
     * @param raw $rawId
     *
     * @return Cart
     */
    public function setRawId($rawId)
    {
        $this->rawId = $rawId;

        return $this;
    }

    /**
     * Get rawId.
     *
     * @return raw
     */
    public function getRawId()
    {
        return $this->rawId;
    }

    /**
     * Set userId.
     *
     * @param int $userId
     *
     * @return Cart
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
