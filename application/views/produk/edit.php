
<div class="row">
    <div class="col-md-8">
        <div class="card card-warning">

            <div class="card-header">
                <h3 class="card-title">Edit Produk</h3>
            </div>

            <form method="post">

                <div class="card-body">

                    <div class="form-group">
                        <label>Kode Produk</label>
                        <input type="text"
                               name="kode_produk"
                               class="form-control"
                               value="<?= $p->kode_produk ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text"
                               name="nama_produk"
                               class="form-control"
                               value="<?= $p->nama_produk ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number"
                               name="harga"
                               class="form-control"
                               value="<?= $p->harga ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number"
                               name="stok"
                               class="form-control"
                               value="<?= $p->stok ?>"
                               required>
                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit"
                            class="btn btn-warning">
                        Update
                    </button>

                    <a href="<?= site_url('produk') ?>"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>
    </div>
</div>
