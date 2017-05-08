<?php

namespace Meldon\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * categoryEntity
 *
 * @ORM\Table(name="category_entity")
 * @ORM\Entity(repositoryClass="Meldon\CatalogBundle\Repository\categoryEntityRepository")
 */
class categoryEntity
{
    /**
     * @return parameterEntity
     */
    public function getParameterEntity()
    {
        return $this->parameterEntity;
    }

    /**
     * @param parameterEntity $parameterEntity
     */
    public function setParameterEntity($parameterEntity)
    {
        $this->parameterEntity = $parameterEntity;
    }

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
     * @var parameterEntity
     * @ORM\OneToMany(targetEntity="parameterEntity", mappedBy="parameter_entity")
     */
    private $parameterEntity;

    /**
     * @var itemEntity
     * @ORM\OneToMany(targetEntity="itemEntity", mappedBy="item_entity")
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
     * Set name
     *
     * @param string $name
     *
     * @return categoryEntity
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
}

