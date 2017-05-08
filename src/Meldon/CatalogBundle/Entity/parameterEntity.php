<?php

namespace Meldon\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * parameterEntity
 *
 * @ORM\Table(name="parameter_entity")
 * @ORM\Entity(repositoryClass="Meldon\CatalogBundle\Repository\parameterEntityRepository")
 */
class parameterEntity
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="typeValue", type="string", length=255)
     */
    private $typeValue;

    /**
     * @var bool
     *
     * @ORM\Column(name="isMain", type="boolean")
     */
    private $isMain;


    /**
     * @var categoryEntity
     * @ORM\ManyToOne(targetEntity="categoryEntity")
     * @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
     */
    private $categoryEntity;

    /**
     * @return categoryEntity
     */
    public function getCategoryEntity()
    {
        return $this->categoryEntity;
    }

    /**
     * @param categoryEntity $categoryEntity
     */
    public function setCategoryEntity($categoryEntity)
    {
        $this->categoryEntity = $categoryEntity;
    }


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
     * @return parameterEntity
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
     * Set typeValue
     *
     * @param string $typeValue
     *
     * @return parameterEntity
     */
    public function setTypeValue($typeValue)
    {
        $this->typeValue = $typeValue;

        return $this;
    }

    /**
     * Get typeValue
     *
     * @return string
     */
    public function getTypeValue()
    {
        return $this->typeValue;
    }

    /**
     * Set isMain
     *
     * @param boolean $isMain
     *
     * @return parameterEntity
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

