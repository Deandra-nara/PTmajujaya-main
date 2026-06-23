<?php
$mysqli = new mysqli("localhost", "root", "");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = file_get_contents("database.sql");

if ($mysqli->multi_query($sql)) {
    do {
        // Store first result set
        if ($result = $mysqli->store_result()) {
            $result->free();
        }
    } while ($mysqli->more_results() && $mysqli->next_result());
    echo "Database setup successfully.\n";
} else {
    echo "Error setting up database: " . $mysqli->error . "\n";
}

$mysqli->close();
?>
