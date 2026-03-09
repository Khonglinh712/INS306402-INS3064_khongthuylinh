<?php
require 'utils.php';

function printResult($testName, $result)
{
    echo $testName . " : " . ($result ? "PASS" : "FAIL") . "<br>";
}

echo "<h2>Testing Validation Utilities</h2>";

/* ---------- SANITIZE TEST ---------- */
$dirty = " <script>alert('x')</script> ";
$clean = sanitize($dirty);

printResult("Sanitize removes script", 
    $clean === htmlspecialchars(trim($dirty), ENT_QUOTES, 'UTF-8')
);

/* ---------- EMAIL TEST ---------- */
printResult("Valid Email", validateEmail("test@example.com"));
printResult("Invalid Email", !validateEmail("bad-email"));

/* ---------- LENGTH TEST ---------- */
printResult("Length Valid", validateLength("hello", 3, 10));
printResult("Length Too Short", !validateLength("hi", 3, 10));
printResult("Length Too Long", !validateLength("thisisaverylongstring", 3, 10));

/* ---------- PASSWORD TEST ---------- */
printResult("Valid Password", validatePassword("Strong@123"));
printResult("Missing Uppercase", !validatePassword("weak@123"));
printResult("Missing Number", !validatePassword("Weak@pass"));
printResult("Too Short", !validatePassword("S@1a"));

echo "<br><strong>All tests executed.</strong>";