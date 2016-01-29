<?php
/**
 * Example of relieving CPU on the web server by using a foreground Gearman
 * job, but using multiple workers so as to minimize the performance impact.
 *
 * ab -n 10000 -c 250 "http://192.168.133.71/demo/4.php"
 *
 * Note: Be sure to run "sudo service gearman-job-server restart && sudo supervisorctl start demo_worker:*" on the worker VM.
 */

// Client code is actually the same as demo3.
require __DIR__ . '/3.php';
