<div class="card">
    <div class="card-header">
        <a href="<?= site_url('user/tambah') ?>" class="btn btn-primary">
            Tambah User
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no=1; foreach($users as $u): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $u->nama ?></td>
                    <td><?= $u->username ?></td>
                    <td><?= ucfirst($u->role) ?></td>
                    <td>
                        <a href="<?= site_url('user/edit/'.$u->id_user) ?>" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a href="<?= site_url('user/hapus/'.$u->id_user) ?>"
                           onclick="return confirm('Hapus user ini?')"
                           class="btn btn-danger btn-sm">
                            Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>