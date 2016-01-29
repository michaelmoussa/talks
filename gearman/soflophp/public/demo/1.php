<?php
/**
 * "Baseline" script to give an example of Apache throughput on a trivial page.
 *
 * ab -n 10000 -c 250 "http://192.168.133.71/demo/1.php"
 */
echo file_get_contents(__DIR__ . '/bootstrap.html');
