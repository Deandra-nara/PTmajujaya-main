
<div class="card">

    <div class="card-header">
        <h3 class="card-title">Laporan Penjualan</h3>
    </div>

    <div class="card-body">

        <form method="get" class="form-inline mb-3">

            <input type="date"
                   name="tanggal_awal"
                   class="form-control mr-2"
                   value="<?= $this->input->get('tanggal_awal') ?>">

            <input type="date"
                   name="tanggal_akhir"
                   class="form-control mr-2"
                   value="<?= $this->input->get('tanggal_akhir') ?>">

            <button type="submit" class="btn btn-primary">
                Filter
            </button>

        </form>

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>No Order</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Sales</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>

            <?php if(empty($laporan)): ?>

                <tr>
                    <td colspan="5" class="text-center">
                        Tidak ada data penjualan
                    </td>
                </tr>

            <?php else: ?>

                <?php foreach($laporan as $l): ?>

                <tr>
                    <td><?= $l->no_order ?></td>
                    <td><?= date('d-m-Y', strtotime($l->tanggal_order)) ?></td>
                    <td><?= $l->nama_pelanggan ?></td>
                    <td><?= $l->nama ?></td>
                    <td>
                        Rp <?= number_format($l->total_harga,0,',','.') ?>
                    </td>
                </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>

            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">
                        Total Penjualan
                    </th>
                    <th>
                        Rp <?= number_format($total_penjualan,0,',','.') ?>
                    </th>
                </tr>
            </tfoot>

        </table>

    </div>

</div>

