<?php
// Define the path to the SQLite database file
$db_file = __DIR__ . '/../data/database.sqlite';

try {
    // Connect to SQLite database
    $pdo = new PDO("sqlite:" . $db_file);
    // Set errormode to exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed. Please ensure setup.php has been run.");
}
?>
