<?php
/**
 * Hog CPU for the specified period of time. Used to simulate
 * an expensive bit of "work" being done.
 */
function doExpensiveThing($hogtime)
{
    $start = microtime(true);

    while (microtime(true) - $start < $hogtime);
}
