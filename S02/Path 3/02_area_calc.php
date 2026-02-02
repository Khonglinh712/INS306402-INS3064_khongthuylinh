<?php
declare(strict_types=1);

function area(float $w, float $h): float {
    return $w * $h;
}

// Test
echo area(5.5, 2);
