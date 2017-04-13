<?php

require_once __DIR__ . '/vendor/autoload.php';

$client = \GraphAware\Neo4j\Client\ClientBuilder::create()
    ->addConnection('bolt', 'bolt://neo4j:password@localhost:7687')
    ->build();

/** @var \GraphAware\Bolt\Result\Result $result */
$result = $client->run(
    'MATCH (customer:Customer {email: { email }})-[:PLACED]->
           (order)-[:CONTAINS]->(product)
    RETURN customer.name, order.date,
           COLLECT(product.name) AS product_list',
    ['email' => 'bob@example.com']
);

/** @var \GraphAware\Common\Result\Record $record */
foreach ($result->getRecords() as $record) {
    echo sprintf(
        "%s ordered [%s] on %s\n",
        $record->get('customer.name'),
        implode(', ', $record->get('product_list')),
        $record->get('order.date')
    );
}
