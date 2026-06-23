
<div class="row">
    <div class="col-md-8">
        <div class="card card-warning">

            <div class="card-header">
                <h3 class="card-title">Edit Pelanggan</h3>
            </div>

            <form method="post">

                <div class="card-body">

                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text"
                               name="nama_pelanggan"
                               class="form-control"
                               value="<?= $p->nama_pelanggan ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="text"
                               name="no_telp"
                               class="form-control"
                               value="<?= $p->no_telp ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat"
                                  class="form-control"
                                  rows="3"
                                  required><?= $p->alamat ?></textarea>
                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit"
                            class="btn btn-warning">
                        Update
                    </button>

                    <a href="<?= site_url('pelanggan') ?>"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>
    </div>
</div>
