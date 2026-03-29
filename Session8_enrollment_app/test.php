<?php
require_once 'classes/Database.php';

try {
    $db = Database::getInstance();
    echo "✅ Connected to database!";
} catch (Exception $e) {
    echo "❌ Connection failed";
}