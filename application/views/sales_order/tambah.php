
<div class="row">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Tambah Sales Order
                </h3>
            </div>

            <form method="post">

                <div class="card-body">

                    <div class="form-group">
                        <label>Pelanggan</label>

                        <select name="id_pelanggan"
                                class="form-control"
                                required>

                            <option value="">
                                Pilih Pelanggan
                            </option>

                            <?php foreach($pelanggan as $p): ?>

                            <option value="<?= $p->id_pelanggan ?>">
                                <?= $p->nama_pelanggan ?>
                            </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Produk</label>

                        <select name="id_produk"
                                class="form-control"
                                required>

                            <option value="">
                                Pilih Produk
                            </option>

                            <?php foreach($produk as $pr): ?>

                            <option value="<?= $pr->id_produk ?>">
                                <?= $pr->nama_produk ?>
                                (Stok : <?= $pr->stok ?>)
                            </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Qty</label>

                        <input type="number"
                               name="qty"
                               class="form-control"
                               min="1"
                               required>
                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit"
                            class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="<?= site_url('sales_order') ?>"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>
</div>

