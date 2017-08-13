<?php

namespace App\Entity;

/**
 * @Entity @Table(name="products")
 */
class Products
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="string", length=100)
     */
    protected $name;

    /**
     * @Column(type="decimal", scale=2)
     */
    protected $price;

    /**
     * @Column(type="text")
     */
    protected $description;
    
    public function getId() 
    {
        return $this->id;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getPrice() 
    {
        return $this->price;
    }

    public function getDescription() 
    {
        return $this->description;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function setName($name) 
    {
        $this->name = $name;
    }

    public function setPrice($price) 
    {
        $this->price = $price;
    }

    public function setDescription($description) 
    {
        $this->description = $description;
    }
}