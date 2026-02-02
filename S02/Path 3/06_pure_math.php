<?php
declare(strict_types=1);

function add(int $a, int $b): int {
    return $a + $b;
}

// Test
$result = add(3, 4);
echo $result;
