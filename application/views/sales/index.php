<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary shadow-sm border-0">

            <div class="card-header bg-light d-flex align-items-center justify-content-between">
                <h3 class="card-title font-weight-bold mb-0 text-dark">
                    <i class="fas fa-user-tie mr-2 text-primary"></i>
                    Daftar Sales
                </h3>

                <div class="card-tools ml-auto">
                    <a href="<?= site_url('sales/tambah') ?>"
                       class="btn btn-primary btn-sm font-weight-bold">
                        <i class="fas fa-plus mr-1"></i>
                        Tambah Sales
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive p-0">

                <table class="table table-bordered table-hover mb-0">

                    <thead>
                        <tr class="bg-light">
                            <th>ID</th>
                            <th>Kode Sales</th>
                            <th>Nama Sales</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if(empty($sales)): ?>

                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                Belum ada data sales.
                            </td>
                        </tr>

                    <?php else: ?>

                        <?php foreach($sales as $s): ?>

                        <tr>

                            <td><?= $s->id_sales ?></td>

                            <td>
                                <span class="badge badge-secondary">
                                    <?= $s->kode_sales ?>
                                </span>
                            </td>

                            <td>
                                <strong><?= $s->nama_sales ?></strong>
                            </td>

                            <td class="text-center">

                                <a href="<?= site_url('sales/edit/'.$s->id_sales) ?>"
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="<?= site_url('sales/hapus/'.$s->id_sales) ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus data sales ini?')">
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