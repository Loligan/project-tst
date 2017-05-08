<?php

namespace Meldon\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * imageEntity
 *
 * @ORM\Table(name="image_entity")
 * @ORM\Entity(repositoryClass="Meldon\CatalogBundle\Repository\imageEntityRepository")
 */
class imageEntity
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
     * @var bool
     *
     * @ORM\Column(name="isSmall", type="boolean")
     */
    private $isSmall;

    /**
     * @return itemEntity
     */
    public function getItemEntity()
    {
        return $this->itemEntity;
    }

    /**
     * @param itemEntity $itemEntity
     */
    public function setItemEntity($itemEntity)
    {
        $this->itemEntity = $itemEntity;
    }

    /**
     * @var bool
     *
     * @ORM\Column(name="isMain", type="boolean")
     */
    private $isMain;


    /**
     * @var itemEntity
     * @ORM\ManyToOne(targetEntity="itemEntity")
     * @ORM\JoinColumn(name="itemId", referencedColumnName="id")
     */
    private $itemEntity;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isSmall
     *
     * @param boolean $isSmall
     *
     * @return imageEntity
     */
    public function setIsSmall($isSmall)
    {
        $this->isSmall = $isSmall;

        return $this;
    }

    /**
     * Get isSmall
     *
     * @return bool
     */
    public function getIsSmall()
    {
        return $this->isSmall;
    }

    /**
     * Set isMain
     *
     * @param boolean $isMain
     *
     * @return imageEntity
     */
    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;

        return $this;
    }

    /**
     * Get isMain
     *
     * @return bool
     */
    public function getIsMain()
    {
        return $this->isMain;
    }
}

