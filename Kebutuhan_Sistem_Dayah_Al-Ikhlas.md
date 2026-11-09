# Kebutuhan Sistem Informasi LPI Dayah Al-Ikhlas Al-Aziziyah (Berbasis Web)

Dokumen ini merangkum kebutuhan sistem berdasarkan dokumen yang diberikan: peraturan dayah, brosur penerimaan santri baru, formulir pendaftaran, kartu SPP, serta format Excel dari Dinas Pendidikan Dayah (data guru, data santri, pendataan dayah).

> Catatan: beberapa angka (tarif, kuota) dibaca dari foto layar dan **perlu dikonfirmasi** dengan pihak dayah sebelum dimasukkan ke sistem.

---

## 1. Tujuan Sistem

1. Menggantikan pencatatan manual (buku besar, kartu SPP kertas, Excel terpisah) dengan satu basis data terpadu.
2. Menyediakan informasi dan promosi dayah secara daring untuk masyarakat dan orang tua calon santri.
3. Menyediakan pendaftaran santri baru secara online.
4. Mempermudah pelaporan ke Dinas Pendidikan Dayah dengan ekspor data sesuai format Dinas.

## 2. Ruang Lingkup

**Termasuk:** profil dan informasi dayah, pendaftaran santri baru online, data santri, data guru, jenjang/kelas/kurikulum, jadwal, pembayaran SPP dan biaya lain, laporan dan ekspor.

**Tidak termasuk (kecuali disepakati):** nilai/rapor, absensi harian, pencatatan pelanggaran santri, pembayaran online (payment gateway), aplikasi mobile.

## 3. Pengguna dan Hak Akses

| Peran | Hak akses |
|---|---|
| Pengunjung (publik) | Melihat profil, fasilitas, peraturan, berita, jadwal kegiatan; mengisi pendaftaran santri baru |
| Admin | Kelola seluruh data (santri, guru, jenjang, jadwal, konten), verifikasi pendaftaran, impor/ekspor, kelola pengguna |
| Bendahara | Input dan lihat pembayaran SPP/biaya lain, rekap tunggakan, cetak kuitansi |
| Pimpinan | Lihat dashboard dan laporan (hanya baca) |
| Orang tua/wali (opsional) | Login untuk melihat status pembayaran anaknya |

## 4. Kebutuhan Fungsional

### 4.1 Halaman Publik (Informasi dan Promosi)
- Beranda: sambutan, ringkasan, tombol daftar santri baru.
- Profil dayah: sejarah, visi, misi, tujuan, legalitas/izin operasional.
- Kurikulum: sistem salafiyah (kitab kuning), daftar bidang studi per jenjang.
- Fasilitas: asrama, ruang belajar, musalla, kantin, dapur (dengan foto).
- Jadwal kegiatan harian santri.
- Peraturan dayah (bidang pendidikan, humas, naker, jamaah).
- Berita/pengumuman dan galeri foto.
- Informasi penerimaan: syarat, biaya, jadwal pendaftaran, kuota.
- Kontak dan peta lokasi.

### 4.2 Pendaftaran Santri Baru (Online)
- Formulir online dengan isian sesuai formulir kertas:
  data santri, alamat, orang tua, pekerjaan orang tua, wali, pihak yang mendaftarkan.
- Isian tambahan agar kompatibel dengan format Dinas: **NIK**, asal sekolah, jenjang/tingkat tujuan.
- Unggah berkas: foto 3x4 / 2x3, fotokopi KK, KTP orang tua, ijazah/SKHU/nilai terakhir (sesuai syarat brosur).
- Nomor pendaftaran otomatis dan halaman bukti pendaftaran (dapat dicetak).
- Status pendaftaran: *Menunggu verifikasi → Diterima / Ditolak / Cadangan*.
- Admin memverifikasi, lalu menekan **"Jadikan Santri"** sehingga data pindah ke tabel santri tanpa input ulang (mencegah redundansi data).
- Pengaturan periode pendaftaran (buka/tutup) dan kuota.

### 4.3 Manajemen Data Santri
- Tambah, ubah, hapus, cari, dan filter (jenjang, kelas, status, tahun masuk).
- Nomor induk santri otomatis atau manual.
- Status: Aktif / Alumni / Keluar.
- Kenaikan kelas dan perpindahan jenjang (massal).
- Cetak biodata dan kartu santri.
- **Impor** dari Excel (format data santri yang sudah ada) dengan validasi dan pratinjau.
- **Ekspor** ke Excel sesuai format Dinas.

### 4.4 Manajemen Data Guru (Teungku)
- CRUD data guru: nama, NIK, nomor induk, pendidikan terakhir, status (PNS/Non PNS, tetap/tidak tetap), bidang studi yang diampu, alamat asal, alamat domisili, jenis kelamin, tempat/tanggal lahir, no HP, email, foto.
- Impor dari Excel dan ekspor ke format EDATUDA (Dinas).

### 4.5 Jenjang, Kelas, dan Kurikulum
- Jenjang: Tajhizi, Ula, Wustha, Ulya, Ma'had Aly (dapat ditambah/diubah).
- Kelas per jenjang dan tahun ajaran.
- Master bidang studi (Al-Qur'an, Fiqih, Nahwu, Saraf, Tauhid, Akhlaq/Tasawuf, Balaghah, Ma'ani, Mantek, Bayan, Tarikh, Tafsir, Ilmu Tafsir, Hadits, Usul Fiqh, Imlak/Insyak, Tahfizh, Mustahalah Hadits, Ilmu Hadits).
- Pemetaan bidang studi ke kelas dan guru pengampu.

### 4.6 Jadwal
- **Jadwal kegiatan harian** (jam, kegiatan, keterangan; mis. bangun tidur, pengajian subuh, shalat berjamaah, istirahat).
- **Jadwal belajar per kelas** (hari, jam, bidang studi, guru).
- Cetak dan tampil di halaman publik.

### 4.7 Pembayaran SPP dan Biaya Lain
- Master jenis pembayaran: SPP bulanan, biaya pendaftaran, sumbangan wajib per tahap (nominal dapat diubah; tarif dikonfirmasi dayah).
- Input pembayaran: santri, jenis, bulan/tahun, tanggal, jumlah, keterangan (sama dengan kolom kartu SPP: Bulan, Tanggal, Jumlah, Ket).
- Tampilan **kartu SPP digital** per santri per tahun (Januari–Desember) dengan status lunas/belum.
- Rekap tunggakan per bulan/kelas/santri.
- Cetak kuitansi dan kartu SPP.
- Laporan penerimaan harian, bulanan, dan tahunan.

### 4.8 Dashboard dan Laporan
- Dashboard: jumlah santri (L/P, per jenjang), jumlah guru, pendaftar baru, pemasukan bulan ini, tunggakan.
- Laporan: data santri, data guru, pendaftaran, pembayaran/tunggakan.
- Ekspor Excel/PDF; ekspor **format Dinas** (data guru, data santri, ringkasan pendataan dayah: jumlah guru dan santri per jenis kelamin, santri dalam/luar kabupaten, jumlah santri per kelas).

### 4.9 Pengaturan dan Pengguna
- Kelola akun dan peran, ubah kata sandi.
- Pengaturan identitas dayah, tahun ajaran, periode pendaftaran.
- Kelola konten (berita, galeri, fasilitas, peraturan).
- Cadangan (backup) basis data.

## 5. Kebutuhan Non-Fungsional

| Aspek | Kebutuhan |
|---|---|
| Keamanan | Login dengan kata sandi ter-hash, hak akses per peran, proteksi SQL injection dan XSS, validasi unggahan file (tipe dan ukuran) |
| Privasi | NIK dan data anak tidak tampil di halaman publik; hanya admin yang dapat melihat NIK; berkas pendaftaran tidak dapat diakses publik |
| Kegunaan | Antarmuka responsif (HP dan laptop), bahasa Indonesia, mudah dipakai staf non-teknis |
| Kinerja | Halaman publik termuat cepat pada jaringan seluler (gambar dikompres) |
| Keandalan | Backup rutin; log aktivitas perubahan data penting |
| Kompatibilitas | Browser modern (Chrome, Firefox, Edge) |
| Pemeliharaan | Kode terstruktur dan terdokumentasi |

## 6. Rancangan Data (Calon Tabel)

| Tabel | Isi utama |
|---|---|
| `users` | id, nama, username, password_hash, role, aktif |
| `profil_dayah` | nama, tahun berdiri, alamat (jalan, dusun, gampong, kemukiman, kecamatan, kabupaten), status kelembagaan, izin operasional, visi, misi, tujuan, kontak, email |
| `tahun_ajaran` | id, nama, tanggal_mulai, tanggal_selesai, aktif |
| `jenjang` | id, nama (Tajhizi/Ula/Wustha/Ulya/Ma'had Aly), keterangan |
| `kelas` | id, jenjang_id, nama_kelas, tahun_ajaran_id, wali_kelas (guru_id) |
| `santri` | id, no_induk, nik, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, anak_ke, jumlah_saudara, alamat asal (gampong, kecamatan, kabupaten, provinsi), alamat_domisili, no_hp, email, asal_sekolah, nama_ayah, nama_ibu, pekerjaan_ayah, pekerjaan_ibu, alamat/no_hp orang tua, nama_wali, pekerjaan_wali, alamat_wali, no_hp_wali, kelas_id, tahun_masuk, status (aktif/alumni/keluar), foto |
| `guru` | id, no_induk, nik, nama, jenis_kelamin, tempat/tanggal lahir, pendidikan_terakhir, status_pns, status_tetap, alamat asal, alamat_domisili, no_hp, email, foto |
| `bidang_studi` | id, nama |
| `kurikulum` | id, kelas_id (atau jenjang), bidang_studi_id, guru_id |
| `jadwal_kegiatan` | id, jam_mulai, jam_selesai, kegiatan, keterangan |
| `jadwal_belajar` | id, kelas_id, hari, jam_mulai, jam_selesai, bidang_studi_id, guru_id |
| `pendaftaran` | id, no_pendaftaran, tahun_ajaran_id, data calon santri (sama seperti `santri`), pihak_pendaftar (nama, pekerjaan, alamat, no_hp), jenjang_tujuan, status, catatan, tanggal_daftar |
| `berkas_pendaftaran` | id, pendaftaran_id, jenis_berkas, nama_file |
| `jenis_pembayaran` | id, nama (SPP, pendaftaran, sumbangan wajib), nominal, periodik (bulanan/sekali/per tahap) |
| `pembayaran` | id, santri_id, jenis_pembayaran_id, tahun, bulan, tanggal_bayar, jumlah, keterangan, petugas_id |
| `berita` | id, judul, isi, gambar, tanggal, status |
| `fasilitas` | id, nama, deskripsi, foto |
| `peraturan` | id, bidang, urutan, isi |
| `galeri` | id, judul, file, tanggal |

Relasi utama: `jenjang 1—N kelas`, `kelas 1—N santri`, `santri 1—N pembayaran`, `jenis_pembayaran 1—N pembayaran`, `kelas N—M bidang_studi` (melalui `kurikulum`), `guru 1—N kurikulum/jadwal_belajar`, `pendaftaran 1—N berkas_pendaftaran`.

## 7. Alur Utama

**Pendaftaran santri baru**
1. Orang tua membuka halaman Penerimaan, mengisi formulir dan mengunggah berkas.
2. Sistem membuat nomor pendaftaran dan bukti pendaftaran.
3. Admin memverifikasi berkas, lalu mengubah status.
4. Jika diterima, admin menjadikannya santri (data tersalin otomatis, kelas ditetapkan).

**Pembayaran SPP**
1. Bendahara memilih santri dan bulan.
2. Bendahara mengisi jumlah dan tanggal, lalu menyimpan.
3. Kartu SPP digital diperbarui dan kuitansi dapat dicetak.
4. Rekap tunggakan diperbarui otomatis.

**Pelaporan ke Dinas**
1. Admin memperbarui data santri dan guru.
2. Admin memilih laporan "Format Dinas".
3. Sistem mengekspor file Excel sesuai template.

## 8. Kebutuhan Teknologi (sesuai proposal)

- Bahasa: PHP, HTML, CSS (JavaScript secukupnya)
- Basis data: MySQL
- Server lokal pengembangan: XAMPP
- Editor: Visual Studio Code
- Pustaka yang disarankan: PhpSpreadsheet (impor/ekspor Excel), Dompdf/TCPDF (cetak PDF)
- Metode pengembangan: Waterfall; pengujian: Black Box Testing (disarankan ditambah uji kegunaan, mis. SUS)
- Keputusan yang masih terbuka: memakai PHP native atau framework (mis. Laravel/CodeIgniter)

## 9. Data yang Perlu Disiapkan dari Dayah

- [ ] Logo, foto fasilitas, dan foto kegiatan
- [ ] Teks profil, visi, misi, tujuan terbaru
- [ ] Peraturan dayah versi terbaru
- [ ] Tarif terbaru (pendaftaran, SPP, sumbangan wajib) dan kuota santri baru
- [ ] Syarat dan jadwal pendaftaran tahun ajaran berjalan
- [ ] Daftar jenjang dan kelas yang aktif
- [ ] Data santri dan guru terbaru (file Excel)
- [ ] Jadwal kegiatan harian dan jadwal belajar terbaru
- [ ] Template resmi Excel Dinas versi terbaru
- [ ] Kontak resmi dan koordinat lokasi

## 10. Hal yang Perlu Dikonfirmasi

1. Apakah santri dibedakan antara yang mondok dan yang tidak, dan apakah tarif SPP berbeda per kategori atau jenjang?
2. Apakah "sumbangan wajib per tahap" dibayar berapa kali dalam setahun?
3. Apakah orang tua perlu login untuk melihat tagihan, atau cukup informasi publik?
4. Siapa saja yang akan mengoperasikan sistem (jumlah admin dan bendahara)?
5. Di mana sistem akan di-hosting (server lokal dayah atau hosting online)?
6. Bagaimana kebijakan penyimpanan NIK dan berkas pribadi (izin dari pihak dayah)?
7. Apakah modul pelanggaran santri atau absensi ingin dimasukkan di tahap berikutnya?

## 11. Rencana Pengujian (Black Box)

| Modul | Contoh skenario |
|---|---|
| Login | Login benar, login salah, akses halaman tanpa login |
| Pendaftaran | Kirim formulir lengkap, kolom wajib kosong, unggah file tidak valid |
| Verifikasi | Terima, tolak, jadikan santri |
| Data santri/guru | Tambah, ubah, hapus, cari, impor Excel dengan data salah |
| Pembayaran | Input bulan baru, input ganda pada bulan yang sama, cetak kuitansi |
| Laporan | Ekspor Excel/PDF dan format Dinas |
| Hak akses | Bendahara tidak bisa membuka menu admin |

## 12. Usulan Tahapan Pengerjaan

1. Rancangan database (ERD) dan struktur menu
2. Login, peran, dan master data (jenjang, kelas, tahun ajaran)
3. Data santri dan data guru (beserta impor Excel)
4. Pendaftaran santri baru online dan verifikasi
5. Pembayaran SPP dan laporan
6. Halaman publik (profil, fasilitas, berita, jadwal)
7. Ekspor format Dinas, pengujian, dan perbaikan
