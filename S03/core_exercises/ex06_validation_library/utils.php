<?php

/**
 * Sanitize input data
 */
function sanitize($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate Email
 */
function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate Length
 */
function validateLength($str, $min, $max)
{
    $length = strlen($str);
    return ($length >= $min && $length <= $max);
}

/**
 * Validate Password
 * Rules:
 * - At least 8 characters
 * - At least 1 uppercase
 * - At least 1 lowercase
 * - At least 1 number
 * - At least 1 special character
 */
function validatePassword($pass)
{
    if (strlen($pass) < 8) return false;
    if (!preg_match('/[A-Z]/', $pass)) return false;
    if (!preg_match('/[a-z]/', $pass)) return false;
    if (!preg_match('/[0-9]/', $pass)) return false;
    if (!preg_match('/[\W_]/', $pass)) return false;

    return true;
}