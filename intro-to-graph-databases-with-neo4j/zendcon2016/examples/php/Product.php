<?php

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="Product")
 */
class Product
{
    /**
     * @OGM\GraphId()
     */
    public $id;

    /**
     * @OGM\Property(type="string")
     */
    public $date;

    /**
     * @OGM\Property(type="string")
     */
    public $description;

    /**
     * @OGM\Property(type="string")
     */
    public $name;

    /**
     * @OGM\Property(type="int")
     */
    public $price;

    /**
     * @OGM\Property(type="int")
     */
    public $productId;
}
