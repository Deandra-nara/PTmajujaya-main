<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Laporan Per Sales
        </h3>
    </div>

    <div class="card-body">
<form method="get" action="<?= site_url('laporan') ?>">

    <div class="row">

        <div class="col-md-3">
            <label>Tanggal Awal</label>
            <input type="date"
                   name="tanggal_awal"
                   class="form-control"
                   value="<?= $this->input->get('tanggal_awal') ?>">
        </div>

        <div class="col-md-3">
            <label>Tanggal Akhir</label>
            <input type="date"
                   name="tanggal_akhir"
                   class="form-control"
                   value="<?= $this->input->get('tanggal_akhir') ?>">
        </div>

        <div class="col-md-6">
            <br>

            <button type="submit"
                    class="btn btn-primary">
                Filter
            </button>

           <a href="<?= site_url('laporan/cetak?tanggal_awal='.$this->input->get('tanggal_awal').'&tanggal_akhir='.$this->input->get('tanggal_akhir')) ?>"
   target="_blank"
   class="btn btn-success">
   Cetak
</a>

        </div>

    </div>

</form>

<hr>
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Sales</th>
                    <th>Jumlah Order</th>
                    <th>Total Penjualan</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach($laporan_sales as $s): ?>

            <tr>
                <td><?= $s->nama ?></td>
                <td><?= $s->jumlah_order ?></td>
                <td>
                    Rp <?= number_format($s->total_penjualan,0,',','.') ?>
                </td>
            </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

<br>

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Laporan Per Produk
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Produk</th>
                    <th>Qty Terjual</th>
                    <th>Total Penjualan</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach($laporan_produk as $p): ?>

            <tr>
                <td><?= $p->kode_produk ?></td>
                <td><?= $p->nama_produk ?></td>
                <td><?= $p->total_qty ?></td>
                <td>
                    Rp <?= number_format($p->total_penjualan,0,',','.') ?>
                </td>
            </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>