<?php
/**
 * Example of relieving CPU on the web server by submitting Gearman
 * jobs with multiple workers, AND improving performance by doing
 * jobs asynchronously.
 *
 * ab -n 10000 -c 250 "http://192.168.133.71/demo/5.php"
 *
 * Note: Be sure to run "sudo gearman-job-server-restart && sudo supervisorctl start demo_worker:*" on the worker VM.
 */
require __DIR__ . '/../../src/util.php';

echo file_get_contents(__DIR__ . '/bootstrap.html');

$client = new \GearmanClient();
$client->addServer('192.168.133.72', 4730);

$client->doBackground(
    'expensive',
    sprintf('{"hogtime": %d}', rand(1, 3))
);
