<?php

namespace Meldon\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * itemEntity
 *
 * @ORM\Table(name="item_entity")
 * @ORM\Entity(repositoryClass="Meldon\CatalogBundle\Repository\itemEntityRepository")
 */
class itemEntity
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
     * @var array
     *
     * @ORM\Column(name="params", type="json_array")
     */
    private $params;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @return int
     */
    public function getisMain()
    {
        return $this->isMain;
    }

    /**
     * @param int $isMain
     */
    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;
    }

    /**
     * @return categoryEntity
     */
    public function getCategoryItem()
    {
        return $this->categoryItem;
    }

    /**
     * @param categoryEntity $categoryItem
     */
    public function setCategoryItem($categoryItem)
    {
        $this->categoryItem = $categoryItem;
    }

    /**
     * @return imageEntity
     */
    public function getImageEntity()
    {
        return $this->imageEntity;
    }

    /**
     * @param imageEntity $imageEntity
     */
    public function setImageEntity($imageEntity)
    {
        $this->imageEntity = $imageEntity;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="qty", type="integer")
     */
    private $isMain;

    /**
     * @var categoryEntity
     * @ORM\ManyToOne(targetEntity="categoryEntity")
     * @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
     */
    private $categoryItem;


    /**
     * @var imageEntity
     * @ORM\OneToMany(targetEntity="imageEntity", mappedBy="image_entity")
     */
    private $imageEntity;


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
     * @return itemEntity
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
     * Set params
     *
     * @param array $params
     *
     * @return itemEntity
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Get params
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return itemEntity
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    public function __toString()
    {
     return $this->name;
    }
}
