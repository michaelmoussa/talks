<?php
/**
 * This script demonstrates the unintuitive behavior of the Gearman
 * library when it comes to servicing jobs of different priorities.
 *
 * We'll use the same script as both the client and the worker for
 * convenience.
 */

// Create our worker
$worker = new \GearmanWorker();
$worker->addServer('192.168.133.72', 4730);

// Create our client
$client = new \GearmanClient();
$client->addServer('192.168.133.72', 4730);

// Service "foo" jobs by displaying "foo"
$worker->addFunction('foo', function (\GearmanJob $job) {
    echo "foo\n";
});

// Service "bar" jobs by displaying "bar"
$worker->addFunction('bar', function (\GearmanJob $job) {
    echo "bar\n";
});

// Add 25 LOW priority "foo" jobs to the queue.
for ($i = 0; $i < 25; $i++) {
    $client->doLowBackground('foo', '{}');
}

// Add 1 HIGH priority "bar" job to the queue.
$client->doHighBackground('bar', '{}');

/**
 * Running ->work() will service the pending jobs.
 *
 * What would you expect the output order to be?
 */
while ($worker->work());
