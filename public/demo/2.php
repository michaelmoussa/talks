<?php
/**
 * Example of how adding expensive operation reduces throughput and quality of
 * service while increasing resource utilization.
 *
 * ab -n 10000 -c 250 "http://192.168.133.71/demo/2.php"
 */
require __DIR__ . '/../../src/util.php';

echo file_get_contents(__DIR__ . '/bootstrap.html');

doExpensiveThing(rand(1, 3));
