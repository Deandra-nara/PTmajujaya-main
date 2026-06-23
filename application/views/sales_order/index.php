
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    Data Order
                </h3>

                <div class="card-tools">
                    <a href="<?= site_url('sales_order/tambah') ?>"
                       class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i>
                        Tambah Orderan
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>No Order</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Sales</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if(empty($sales_order)): ?>

                        <tr>
                            <td colspan="7" class="text-center">
                                Belum ada data
                            </td>
                        </tr>

                    <?php else: ?>

                        <?php foreach($sales_order as $s): ?>

                        <tr>
                            <td><?= $s->no_order ?></td>
                            <td><?= $s->tanggal_order ?></td>
                            <td><?= $s->nama_pelanggan ?></td>
                            <td><?= $s->nama ?></td>
                            <td>
                                Rp <?= number_format($s->total_harga,0,',','.') ?>
                            </td>

                            <td>
                                <span class="badge badge-success">
                                    <?= $s->status ?>
                                </span>
                            </td>

                            <td>

    <a href="<?= site_url('sales_order/detail/'.$s->id_order) ?>"
       class="btn btn-info btn-sm">
        Detail
    </a>

    <?php if($s->status == 'draft'): ?>

        <a href="<?= site_url('sales_order/ubah_status/'.$s->id_order.'/dikirim') ?>"
           class="btn btn-warning btn-sm"
           onclick="return confirm('Ubah status menjadi dikirim?')">
            Kirim
        </a>

    <?php endif; ?>


    <?php if($s->status == 'dikirim'): ?>

        <a href="<?= site_url('sales_order/ubah_status/'.$s->id_order.'/selesai') ?>"
           class="btn btn-success btn-sm"
           onclick="return confirm('Selesaikan order ini?')">
            Selesai
        </a>

    <?php endif; ?>


    <?php if($s->status != 'selesai' && $s->status != 'dibatalkan'): ?>

        <a href="<?= site_url('sales_order/ubah_status/'.$s->id_order.'/dibatalkan') ?>"
           class="btn btn-secondary btn-sm"
           onclick="return confirm('Batalkan order ini?')">
            Batalkan
        </a>

    <?php endif; ?>


    <a href="<?= site_url('sales_order/hapus/'.$s->id_order) ?>"
       class="btn btn-danger btn-sm"
       onclick="return confirm('Yakin hapus data?')">
        Hapus
    </a>

</td>
                        </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

