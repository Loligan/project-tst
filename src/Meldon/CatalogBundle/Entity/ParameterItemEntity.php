<?php

namespace Meldon\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParameterItemEntity
 *
 * @ORM\Table(name="parameter_item_entity")
 * @ORM\Entity(repositoryClass="Meldon\CatalogBundle\Repository\ParameterItemEntityRepository")
 */
class ParameterItemEntity
{
    /**
     * @return itemEntity
     */
    public function getItemEntityId()
    {
        return $this->itemEntityId;
    }

    /**
     * @param itemEntity $itemEntityId
     */
    public function setItemEntityId($itemEntityId)
    {
        $this->itemEntityId = $itemEntityId;
    }
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="isNumber", type="boolean")
     */
    private $isNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="stringValue", type="string", length=255, nullable=true)
     */
    private $stringValue;

    /**
     * @var int
     *
     * @ORM\Column(name="numberValue", type="integer", nullable=true)
     */
    private $numberValue;

    /**
     * @var itemEntity
     * @ORM\ManyToOne(targetEntity="itemEntity")
     * @ORM\JoinColumn(name="itemId", referencedColumnName="id")
     */
    private $itemEntityId;

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
     * Set name
     *
     * @param string $name
     *
     * @return ParameterItemEntity
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set isNumber
     *
     * @param boolean $isNumber
     *
     * @return ParameterItemEntity
     */
    public function setIsNumber($isNumber)
    {
        $this->isNumber = $isNumber;

        return $this;
    }

    /**
     * Get isNumber
     *
     * @return bool
     */
    public function getIsNumber()
    {
        return $this->isNumber;
    }

    /**
     * Set stringValue
     *
     * @param string $stringValue
     *
     * @return ParameterItemEntity
     */
    public function setStringValue($stringValue)
    {
        $this->stringValue = $stringValue;

        return $this;
    }

    /**
     * Get stringValue
     *
     * @return string
     */
    public function getStringValue()
    {
        return $this->stringValue;
    }

    /**
     * Set numberValue
     *
     * @param integer $numberValue
     *
     * @return ParameterItemEntity
     */
    public function setNumberValue($numberValue)
    {
        $this->numberValue = $numberValue;

        return $this;
    }

    /**
     * Get numberValue
     *
     * @return int
     */
    public function getNumberValue()
    {
        return $this->numberValue;
    }
}

