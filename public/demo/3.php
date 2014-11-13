<?php
/**
 * Example of relieving CPU on the web server by using a foreground Gearman
 * job, but negatively affecting performance due to having only a single
 * worker.
 *
 * ab -n 10000 -c 250 "http://192.168.133.71/demo/3.php"
 *
 * Note: Be sure to run "sudo service gearman-job-server restart && php /vagrant/src/worker.php" on the worker VM.
 */
require __DIR__ . '/../../src/util.php';

echo file_get_contents(__DIR__ . '/bootstrap.html');

$client = new \GearmanClient();
$client->addServer('192.168.133.72', 4730);

$client->doNormal(
    'expensive',
    sprintf('{"hogtime": %d}', rand(1, 3))
);
