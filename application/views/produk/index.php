
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary shadow-sm border-0">

            <div class="card-header bg-light d-flex align-items-center justify-content-between">
                <h3 class="card-title font-weight-bold mb-0 text-dark">
                    <i class="fas fa-box mr-2 text-primary"></i>
                    Daftar Produk
                </h3>

                <div class="card-tools ml-auto">
                    <a href="<?= site_url('produk/tambah') ?>"
                       class="btn btn-primary btn-sm font-weight-bold">
                        <i class="fas fa-plus mr-1"></i>
                        Tambah Produk
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive p-0">

                <table class="table table-bordered table-hover mb-0">

                    <thead>
                        <tr class="bg-light">
                            <th>ID</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Created At</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if(empty($produk)): ?>

                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Belum ada data produk.
                            </td>
                        </tr>

                    <?php else: ?>

                        <?php foreach($produk as $p): ?>

                        <tr>

                            <td><?= $p->id_produk ?></td>

                            <td>
                                <span class="badge badge-secondary">
                                    <?= $p->kode_produk ?>
                                </span>
                            </td>

                            <td>
                                <strong><?= $p->nama_produk ?></strong>
                            </td>

                            <td>
                                Rp <?= number_format($p->harga,0,',','.') ?>
                            </td>

                            <td class="text-center">

                                <?php if($p->stok > 10): ?>
                                    <span class="badge badge-success">
                                        <?= $p->stok ?>
                                    </span>

                                <?php elseif($p->stok > 0): ?>
                                    <span class="badge badge-warning">
                                        <?= $p->stok ?>
                                    </span>

                                <?php else: ?>
                                    <span class="badge badge-danger">
                                        Habis
                                    </span>
                                <?php endif; ?>

                            </td>

                            <td>
                                <?= date('d-m-Y H:i', strtotime($p->created_at)) ?>
                            </td>

                            <td class="text-center">

                                <a href="<?= site_url('produk/edit/'.$p->id_produk) ?>"
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="<?= site_url('produk/hapus/'.$p->id_produk) ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    <i class="fas fa-trash"></i>
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

