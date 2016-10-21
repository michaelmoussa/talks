<?php

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="Customer")
 */
class Customer
{
    /**
     * @OGM\GraphId()
     */
    public $id;

    /**
     * @OGM\Property(type="string")
     */
    public $email;

    /**
     * @OGM\Property(type="string")
     */
    public $name;

    /**
     * @OGM\Relationship(type="PLACED", direction="OUTGOING", targetEntity="Order",
     *                   mappedBy="customer", collection=true)
     */
    public $orders;
}
