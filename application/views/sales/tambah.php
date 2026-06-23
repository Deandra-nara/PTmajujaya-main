<div class="card">

    <form method="post">

        <div class="card-body">

            <div class="form-group">
                <label>Kode Sales</label>

                <input type="text"
                       name="kode_sales"
                       class="form-control"
                       required>
            </div>

            <div class="form-group">
                <label>Nama Sales</label>

                <input type="text"
                       name="nama_sales"
                       class="form-control"
                       required>
            </div>

        </div>

        <div class="card-footer">

            <button type="submit"
                    class="btn btn-primary">
                Simpan
            </button>

            <a href="<?= site_url('sales') ?>"
               class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </form>

</div>