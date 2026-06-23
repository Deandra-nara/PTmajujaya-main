<form method="post">

    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Role</label>

        <select name="role" class="form-control" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="sales">Sales</option>
            <option value="sales">Manager</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>

    <a href="<?= site_url('user') ?>" class="btn btn-secondary">
        Kembali
    </a>

</form>