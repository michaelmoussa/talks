<?php
/**
 * This script demonstrates how to work around Gearman's unintuitive behavior
 * when it comes to servicing jobs of different priorities.
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

// Use the same "Function" (i.e. queue) name and distinguish jobs by workload.
$worker->addFunction('foobar', function (\GearmanJob $job) {
    $workload = json_decode($job->workload(), true);

    echo $workload['function'] . "\n";
});

// Add 25 LOW priority "foo" jobs to the queue.
for ($i = 0; $i < 25; $i++) {
    $client->doLowBackground('foobar', '{"function": "foo"}');
}

// Add 1 HIGH priority "bar" job to the queue.
$client->doHighBackground('foobar', '{"function": "bar"}');

/**
 * Running ->work() will service the pending jobs.
 *
 * Notice how the HIGH priority job is serviced *FIRST* this time.
 */
while ($worker->work());
