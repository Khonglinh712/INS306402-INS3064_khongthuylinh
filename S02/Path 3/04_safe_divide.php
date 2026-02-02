<?php
declare(strict_types=1);

function safeDiv(float $a, float $b): ?float {
    if ($b == 0.0) {
        return null;
    }
    return $a / $b;
}

// Test
var_export(safeDiv(10, 0));
