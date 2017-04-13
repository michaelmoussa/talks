<?php

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="Order")
 */
class Order
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
     * @OGM\Relationship(type="CONTAINS", direction="OUTGOING", targetEntity="Product", collection=true)
     */
    public $products;

    /**
     * @OGM\Relationship(type="PLACED", direction="INCOMING", targetEntity="Customer", collection=false)
     */
    public $customer;
}
