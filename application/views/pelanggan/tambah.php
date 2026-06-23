
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Tambah Pelanggan</h3>
            </div>

            <form method="post">

                <div class="card-body">

                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text"
                               name="nama_pelanggan"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="text"
                               name="no_telp"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat"
                                  class="form-control"
                                  rows="3"
                                  required></textarea>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        Simpan
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

