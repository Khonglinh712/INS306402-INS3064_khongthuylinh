<?php
declare(strict_types=1);

function fmt(float $amt, string $c = '$'): string {
    return $c . number_format($amt, 2);
}

// Test
echo fmt(50);
