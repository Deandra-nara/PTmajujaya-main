<!DOCTYPE html>
<html>
<head>
<title>Cetak Laporan</title>

<style>

body{
    font-family: Arial, sans-serif;
}

table{
    width:100%;
    border-collapse:collapse;
}

table,th,td{
    border:1px solid #000;
}

th,td{
    padding:8px;
    text-align:left;
}

</style>

</head>
<body>

<h2 align="center">
LAPORAN PENJUALAN PER SALES
</h2>

<table>

<tr>
    <th>No</th>
    <th>Nama Sales</th>
    <th>Jumlah Order</th>
    <th>Total Penjualan</th>
</tr>

<?php $no=1; ?>

<?php foreach($laporan_sales as $l): ?>

<tr>

    <td><?= $no++ ?></td>

    <td><?= $l->nama ?></td>

    <td><?= $l->jumlah_order ?></td>

    <td>
        Rp <?= number_format($l->total_penjualan,0,',','.') ?>
    </td>

</tr>

<?php endforeach; ?>

</table>

<script>
window.print();
</script>

</body>
</html>