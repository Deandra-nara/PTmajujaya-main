<form method="post">

    <div class="form-group">
        <label>Nama</label>

        <input type="text"
               name="nama"
               class="form-control"
               value="<?= $user->nama ?>"
               required>
    </div>

    <div class="form-group">
        <label>Username</label>

        <input type="text"
               name="username"
               class="form-control"
               value="<?= $user->username ?>"
               required>
    </div>

    <div class="form-group">
        <label>Password Baru</label>

        <input type="password"
               name="password"
               class="form-control">

        <small>Kosongkan jika tidak ingin mengganti password.</small>
    </div>

    <div class="form-group">
        <label>Role</label>

        <select name="role" class="form-control">

            <option value="admin"
            <?= ($user->role=='admin')?'selected':'' ?>>
                Admin
            </option>

            <option value="sales"
            <?= ($user->role=='sales')?'selected':'' ?>>
                Sales
            </option>

            <option value="manager"
            <?= ($user->role=='manager')?'selected':'' ?>>
                Manager
            </option>

        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        Update
    </button>

    <a href="<?= site_url('user') ?>" class="btn btn-secondary">
        Kembali
    </a>

</form>