
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary shadow-sm border-0">
            <div class="card-header bg-light d-flex align-items-center justify-content-between">
                <h3 class="card-title font-weight-bold mb-0 text-dark">
                    <i class="fas fa-users mr-2 text-primary"></i>
                    Daftar Pelanggan
                </h3>

                <div class="card-tools ml-auto">
                    <a href="<?= site_url('produk/tambah') ?>"
                       class="btn btn-primary btn-sm font-weight-bold">
                        <i class="fas fa-plus mr-1"></i>
                        Tambah Pelanggan
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Pelanggan</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Created At</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if(empty($pelanggan)): ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                Tidak ada data pelanggan
                            </td>
                        </tr>
                    <?php else: ?>

                        <?php foreach($pelanggan as $p): ?>
                        <tr>
                            <td><?= $p->id_pelanggan ?></td>
                            <td><?= $p->nama_pelanggan ?></td>
                            <td><?= $p->no_telp ?></td>
                            <td><?= $p->alamat ?></td>
                            <td><?= $p->created_at ?></td>

                            <td>
                                <a href="<?= site_url('pelanggan/edit/'.$p->id_pelanggan) ?>"
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <a href="<?= site_url('pelanggan/hapus/'.$p->id_pelanggan) ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
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

