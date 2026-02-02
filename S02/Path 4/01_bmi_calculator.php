<?php
declare(strict_types=1);

function calculateBMI(float $kg, float $m): string
{
    if ($m <= 0) {
        return "Invalid height";
    }

    $bmi = $kg / ($m * $m);
    $bmiRounded = round($bmi, 1);

    if ($bmi < 18.5) {
        $category = "Underweight";
    } elseif ($bmi < 25) {
        $category = "Normal";
    } else {
        $category = "Overweight";
    }

    return "BMI: {$bmiRounded} ({$category})";
}

// Test
echo calculateBMI(70, 1.78);
