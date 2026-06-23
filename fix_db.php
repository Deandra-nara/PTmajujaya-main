<?php
define('BASEPATH', dirname(__FILE__) . '/system/');
define('APPPATH', dirname(__FILE__) . '/application/');
define('ENVIRONMENT', 'development');

require_once APPPATH . 'config/database.php';
$dbconfig = $db['default'];

$conn = new mysqli($dbconfig['hostname'], $dbconfig['username'], $dbconfig['password'], $dbconfig['database']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE pembayaran SET bukti_transfer = NULL WHERE bukti_transfer = 'bukti_bayar.png'";

if ($conn->query($sql) === TRUE) {
    echo "DB Updated\n";
} else {
    echo "Error: " . $conn->error . "\n";
}

$conn->close();
?>
