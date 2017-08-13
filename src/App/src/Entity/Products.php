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
    public $id;

    /**
     * @Column(type="string", length=100)
     */
    public $name;

    /**
     * @Column(type="decimal", scale=2)
     */
    public $price;

    /**
     * @Column(type="text")
     */
    public $description;
}