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

// 1. ALTER TABLE
$sql_alter = "ALTER TABLE detail_penyewaan 
ADD COLUMN tarif_kendaraan_snapshot DECIMAL(15,2) NULL,
ADD COLUMN nama_kendaraan_snapshot VARCHAR(255) NULL,
ADD COLUMN plat_nomor_snapshot VARCHAR(50) NULL;";

if ($conn->query($sql_alter) === TRUE) {
    echo "Columns added successfully.\n";
} else {
    echo "Error adding columns: " . $conn->error . "\n";
}

// 2. BACKFILL
$sql_backfill = "UPDATE detail_penyewaan dp
JOIN kendaraan k ON dp.id_kendaraan = k.id_kendaraan
SET 
dp.nama_kendaraan_snapshot = k.merk,
dp.plat_nomor_snapshot = k.plat_nomor,
dp.tarif_kendaraan_snapshot = k.harga_sewa_harian
WHERE dp.nama_kendaraan_snapshot IS NULL;";

if ($conn->query($sql_backfill) === TRUE) {
    echo "Backfill successful. Rows updated: " . $conn->affected_rows . "\n";
} else {
    echo "Error during backfill: " . $conn->error . "\n";
}

$conn->close();
?>
