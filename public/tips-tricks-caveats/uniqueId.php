<?php
/**
 * This script demonstrates how using the $uniqueId parameter prevents
 * queueing duplicate jobs.
 */

// Create our worker
$worker = new \GearmanWorker();
$worker->addServer('192.168.133.72', 4730);

// Create our client
$client = new \GearmanClient();
$client->addServer('192.168.133.72', 4730);

// Use the same "Function" (i.e. queue) name and distinguish jobs by workload.
$worker->addFunction('foobar', function (\GearmanJob $job) {
    echo "foobar\n";
});

for ($i = 0; $i < 25; $i++) {
    $functionName = 'foobar';
    $workload = json_encode(['foo' => 'bar']);
    $uniqueId = md5($functionName . $workload);

    $client->doBackground($functionName, $workload, $uniqueId);
}

/**
 * Running ->work() will service the pending jobs.
 *
 * How many times should "foobar" display?
 */
while ($worker->work());
