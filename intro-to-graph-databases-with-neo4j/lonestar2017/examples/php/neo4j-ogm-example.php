<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/Customer.php';
require __DIR__ . '/Order.php';
require __DIR__ . '/Product.php';

$entityManager = \GraphAware\Neo4j\OGM\EntityManager::create(
    'bolt://neo4j:password@localhost:7687'
);

$customer = $entityManager
                ->getRepository(Customer::class)
                ->findOneBy(['email' => 'bob@example.com']);

foreach ($customer->orders as $order) {
    $products = array_reduce(
        $order->products->toArray(),
        function ($productNames, $product) {
            $productNames[] = $product->name;
            return $productNames;
        }
    );
    echo sprintf(
        "%s ordered [%s] on %s\n",
        $customer->name,
        implode(', ', $products),
        $order->date
    );
}
