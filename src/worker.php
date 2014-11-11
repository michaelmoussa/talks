<?php

require __DIR__ . '/util.php';

$worker = new \GearmanWorker();
$worker->addServer('127.0.0.1', 4730);

$worker->addFunction('expensive', function (\GearmanJob $job) {
    $workload = json_decode($job->workload(), true);
    doExpensiveThing($workload['hogtime']);
});

while ($worker->work());
