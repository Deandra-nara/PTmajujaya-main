CREATE DATABASE IF NOT EXISTS db_global_rentcar;
USE db_global_rentcar;

-- =========================
-- TABLE ADMIN
-- =========================
CREATE TABLE admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nama_admin VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    no_hp VARCHAR(20)
);

-- =========================
-- TABLE MANAGER
-- =========================
CREATE TABLE manager (
    id_manager INT AUTO_INCREMENT PRIMARY KEY,
    nama_manager VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- =========================
-- TABLE PELANGGAN
-- =========================
CREATE TABLE pelanggan (
    id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelanggan VARCHAR(100) NOT NULL,
    alamat TEXT,
    no_hp VARCHAR(20),
    no_ktp VARCHAR(30),
    status_member VARCHAR(20)
);

-- =========================
-- TABLE KENDARAAN
-- =========================
CREATE TABLE kendaraan (
    id_kendaraan INT AUTO_INCREMENT PRIMARY KEY,
    merk VARCHAR(100) NOT NULL,
    tipe VARCHAR(100),
    jenis_kendaraan VARCHAR(100),
    plat_nomor VARCHAR(20) UNIQUE,
    tahun YEAR,
    warna VARCHAR(50),
    harga_sewa_jam DECIMAL(12,2),
    harga_sewa_harian DECIMAL(12,2),
    status_kendaraan VARCHAR(20) DEFAULT 'available',
    kelas_kendaraan VARCHAR(50)
);

-- =========================
-- TABLE SUPIR
-- =========================
CREATE TABLE supir (
    id_supir INT AUTO_INCREMENT PRIMARY KEY,
    nama_supir VARCHAR(100) NOT NULL,
    alamat TEXT,
    no_hp VARCHAR(20),
    no_sim VARCHAR(50),
    tarif_supir DECIMAL(12,2),
    status_supir VARCHAR(20) DEFAULT 'available'
);

-- =========================
-- TABLE PENYEWAAN
-- =========================
CREATE TABLE penyewaan (
    id_penyewaan INT AUTO_INCREMENT PRIMARY KEY,
    id_pelanggan INT,
    id_admin INT,
    tanggal_sewa DATETIME,
    tanggal_kembali DATETIME,
    durasi_sewa INT,
    jenis_sewa VARCHAR(50),
    jenis_perjalanan VARCHAR(100),
    tujuan_perjalanan VARCHAR(255),
    biaya_luar_kota DECIMAL(12,2) DEFAULT 0,
    layanan_antar_jemput BOOLEAN DEFAULT FALSE,
    biaya_antar_jemput DECIMAL(12,2) DEFAULT 0,
    status_penyewaan VARCHAR(50),
    total_biaya DECIMAL(12,2),

    CONSTRAINT fk_penyewaan_pelanggan
        FOREIGN KEY (id_pelanggan)
        REFERENCES pelanggan(id_pelanggan)
        ON DELETE CASCADE,

    CONSTRAINT fk_penyewaan_admin
        FOREIGN KEY (id_admin)
        REFERENCES admin(id_admin)
        ON DELETE CASCADE
);

-- =========================
-- TABLE DETAIL PENYEWAAN
-- =========================
CREATE TABLE detail_penyewaan (
    id_detail_penyewaan INT AUTO_INCREMENT PRIMARY KEY,
    id_penyewaan INT,
    id_kendaraan INT,
    id_supir INT,
    status_upgrade BOOLEAN DEFAULT FALSE,
    keterangan_upgrade VARCHAR(255),
    biaya_upgrade DECIMAL(12,2) DEFAULT 0,
    catatan TEXT,

    CONSTRAINT fk_detail_penyewaan
        FOREIGN KEY (id_penyewaan)
        REFERENCES penyewaan(id_penyewaan)
        ON DELETE CASCADE,

    CONSTRAINT fk_detail_kendaraan
        FOREIGN KEY (id_kendaraan)
        REFERENCES kendaraan(id_kendaraan)
        ON DELETE CASCADE,

    CONSTRAINT fk_detail_supir
        FOREIGN KEY (id_supir)
        REFERENCES supir(id_supir)
        ON DELETE SET NULL
);

-- =========================
-- TABLE PEMBAYARAN
-- =========================
CREATE TABLE pembayaran (
    id_pembayaran INT AUTO_INCREMENT PRIMARY KEY,
    id_penyewaan INT,
    tanggal_bayar DATETIME,
    metode_pembayaran VARCHAR(50),
    jumlah_bayar DECIMAL(12,2),
    bukti_transfer VARCHAR(255),
    status_verifikasi VARCHAR(50),
    status_pembayaran VARCHAR(50),

    CONSTRAINT fk_pembayaran_penyewaan
        FOREIGN KEY (id_penyewaan)
        REFERENCES penyewaan(id_penyewaan)
        ON DELETE CASCADE
);

-- =========================
-- TABLE PENGEMBALIAN
-- =========================
CREATE TABLE pengembalian (
    id_pengembalian INT AUTO_INCREMENT PRIMARY KEY,
    id_penyewaan INT,
    tanggal_pengembalian DATETIME,
    keterlambatan INT DEFAULT 0,
    denda_keterlambatan DECIMAL(12,2) DEFAULT 0,
    kondisi_kendaraan VARCHAR(100),
    catatan_pengembalian TEXT,
    status_pengembalian VARCHAR(50),

    CONSTRAINT fk_pengembalian_penyewaan
        FOREIGN KEY (id_penyewaan)
        REFERENCES penyewaan(id_penyewaan)
        ON DELETE CASCADE
);

-- =========================
-- TABLE LAPORAN OPERASIONAL
-- =========================
CREATE TABLE laporan_operasional (
    id_laporan_operasional INT AUTO_INCREMENT PRIMARY KEY,
    periode VARCHAR(50),
    jumlah_penyewaan INT,
    jumlah_kendaraan_aktif INT,
    tanggal_cetak DATE
);

-- =========================
-- TABLE LAPORAN PENDAPATAN
-- =========================
CREATE TABLE laporan_pendapatan (
    id_laporan_pendapatan INT AUTO_INCREMENT PRIMARY KEY,
    periode VARCHAR(50),
    total_pendapatan DECIMAL(12,2),
    total_denda DECIMAL(12,2),
    pendapatan_layanan_tambahan DECIMAL(12,2),
    tanggal_cetak DATE
);

-- =========================
-- DEFAULT ADMIN
-- username : admin
-- password : admin123
-- =========================
INSERT INTO admin (
    nama_admin,
    username,
    password,
    no_hp
) VALUES (
    'Administrator',
    'admin',
    MD5('admin123'),
    '08123456789'
);

-- =========================
-- DEFAULT MANAGER
-- username : manager
-- password : manager123
-- =========================
INSERT INTO manager (
    nama_manager,
    username,
    password
) VALUES (
    'Manager',
    'manager',
    MD5('manager123')
);