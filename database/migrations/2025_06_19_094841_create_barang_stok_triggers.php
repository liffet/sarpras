<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Trigger: Kurangi stok setelah insert ke tabel peminjaman
        DB::unprepared("
            CREATE TRIGGER kurangi_stok_setelah_peminjaman
            AFTER INSERT ON peminjaman
            FOR EACH ROW
            BEGIN
                UPDATE barang
                SET stok = stok - NEW.jumlah
                WHERE id = NEW.barang_id;
            END
        ");

        // Trigger: Tambah stok setelah insert ke tabel pengembalians
        DB::unprepared("
            CREATE TRIGGER tambah_stok_setelah_pengembalian
            AFTER INSERT ON pengembalians
            FOR EACH ROW
            BEGIN
                DECLARE barangId INT;
                DECLARE jumlahPinjam INT;

                SELECT barang_id, jumlah
                INTO barangId, jumlahPinjam
                FROM peminjaman
                WHERE id = NEW.peminjaman_id;

                UPDATE barang
                SET stok = stok + jumlahPinjam
                WHERE id = barangId;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS kurangi_stok_setelah_peminjaman");
        DB::unprepared("DROP TRIGGER IF EXISTS tambah_stok_setelah_pengembalian");
    }
};
