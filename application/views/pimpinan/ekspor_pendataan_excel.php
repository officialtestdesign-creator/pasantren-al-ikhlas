<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if gte mso 9]>
<xml>
 <x:ExcelWorkbook>
  <x:ExcelWorksheets>
   <x:ExcelWorksheet>
    <x:Name>Pendataan Dayah</x:Name>
    <x:WorksheetOptions>
     <x:DisplayGridlines/>
    </x:WorksheetOptions>
   </x:ExcelWorksheet>
  </x:ExcelWorksheets>
 </x:ExcelWorkbook>
</xml>
<![endif]-->
<style>
  body { font-family: Calibri, Arial, sans-serif; font-size: 11pt; }
  table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
  .title-main { font-size: 14pt; font-weight: bold; color: #854d0e; text-align: left; }
  .title-sub { font-size: 11pt; font-weight: bold; color: #333333; margin-bottom: 10px; }
  .section-header { background-color: #fef08a; font-weight: bold; font-size: 11pt; color: #713f12; padding: 6px 10px; border: 1px solid #ca8a04; }
  th { background-color: #854d0e; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 6px 8px; font-size: 10pt; }
  td { border: 1px solid #cccccc; padding: 5px 8px; font-size: 10pt; }
  .label-cell { background-color: #fafafa; font-weight: 600; width: 280px; }
  .text-str { mso-number-format: "\@"; }
  .text-center { text-align: center; }
  .text-right { text-align: right; }
  .row-even { background-color: #fefce8; }
  .footer-row { background-color: #fef08a; font-weight: bold; border-top: 2px solid #854d0e; }
</style>
</head>
<body>

<table>
    <tr>
        <td colspan="7" class="title-main"><?= strtoupper(html_escape($profil->nama_dayah ?? 'LPI DAYAH AL-IKHLAS AL-AZIZIYAH')); ?></td>
    </tr>
    <tr>
        <td colspan="7" class="title-sub">RINGKASAN PENDATAAN KELEMBAGAAN, SANTRI & ROMBEL FORMAT DINAS PENDIDIKAN DAYAH</td>
    </tr>
    <tr>
        <td colspan="7" style="color: #666; font-size: 9pt;">Tanggal Ekspor: <?= $tanggal_cetak; ?></td>
    </tr>
</table>

<!-- BAGIAN I: PROFIL IDENTITAS -->
<table>
    <tr>
        <td colspan="2" class="section-header">I. DATA IDENTITAS & KELEMBAGAAN DAYAH</td>
    </tr>
    <tr>
        <td class="label-cell">Nama Lembaga (Dayah)</td>
        <td><?= html_escape($profil->nama_dayah); ?></td>
    </tr>
    <tr>
        <td class="label-cell">Tahun Berdiri</td>
        <td class="text-str"><?= html_escape($profil->tahun_berdiri ?? '2007'); ?></td>
    </tr>
    <tr>
        <td class="label-cell">Pimpinan Dayah</td>
        <td style="font-weight: bold;"><?= html_escape($profil->nama_pimpinan ?: 'Tgk. H. Muhammad Nasir'); ?></td>
    </tr>
    <tr>
        <td class="label-cell">Status Kelembagaan</td>
        <td><?= html_escape($profil->status_kelembagaan ?: 'Yayasan / Lembaga Pendidikan Islam'); ?></td>
    </tr>
    <tr>
        <td class="label-cell">Nomor Izin Operasional (NSPP)</td>
        <td class="text-str"><?= html_escape($profil->izin_operasional ?: 'Kd.01.02/5/PP.00.7/142/2018'); ?></td>
    </tr>
    <tr>
        <td class="label-cell">Alamat Lembaga</td>
        <td>Gampong <?= html_escape($profil->gampong ?: 'Sangso'); ?>, Kec. <?= html_escape($profil->kecamatan ?: 'Samalanga'); ?>, Kab. <?= html_escape($profil->kabupaten ?: 'Bireuen'); ?> - Aceh</td>
    </tr>
    <tr>
        <td class="label-cell">Kontak & Email Resmi</td>
        <td class="text-str"><?= html_escape($profil->no_hp ?: '-'); ?> / <?= html_escape($profil->email ?: '-'); ?></td>
    </tr>
</table>

<!-- BAGIAN II: REKAPITULASI SANTRI -->
<table>
    <tr>
        <td colspan="2" class="section-header">II. REKAPITULASI DEMOGRAFI SANTRI</td>
    </tr>
    <tr>
        <td class="label-cell">Total Santri Aktif Terdaftar</td>
        <td style="font-weight: bold;"><?= (int)$stats['santri_total']; ?> Santri</td>
    </tr>
    <tr>
        <td class="label-cell">Santri Laki-laki (Putra / Banin)</td>
        <td><?= (int)$stats['santri_putra']; ?> Santri</td>
    </tr>
    <tr>
        <td class="label-cell">Santri Perempuan (Putri / Banat)</td>
        <td><?= (int)$stats['santri_putri']; ?> Santri</td>
    </tr>
    <tr>
        <td class="label-cell">Santri Asal Wilayah Kabupaten Bireuen</td>
        <td><?= (int)$santri_dalam_kab; ?> Santri</td>
    </tr>
    <tr>
        <td class="label-cell">Santri Asal Luar Kabupaten Bireuen</td>
        <td><?= (int)$santri_luar_kab; ?> Santri</td>
    </tr>
</table>

<!-- BAGIAN III: REKAPITULASI ROMBEL / KELAS -->
<table>
    <thead>
        <tr>
            <th colspan="7" style="background-color: #854d0e; text-align: left; padding: 6px 10px;">III. REKAPITULASI JUMLAH SANTRI PER ROMBEL / KELAS</th>
        </tr>
        <tr>
            <th style="width: 40px;">NO</th>
            <th>TINGKAT / JENJANG</th>
            <th>NAMA ROMBEL / KELAS</th>
            <th>TAHUN AJARAN</th>
            <th style="width: 100px;">LAKI-LAKI</th>
            <th style="width: 100px;">PEREMPUAN</th>
            <th style="width: 110px;">TOTAL SANTRI</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1; 
        $tot_l = 0; 
        $tot_p = 0; 
        $tot_all = 0;
        if (!empty($rekap_kelas)):
            foreach ($rekap_kelas as $rk): 
                $tot_l += (int)$rk->laki_laki;
                $tot_p += (int)$rk->perempuan;
                $tot_all += (int)$rk->jumlah;
        ?>
            <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td class="text-center"><?= html_escape($rk->jenjang); ?></td>
                <td style="font-weight: bold;"><?= html_escape($rk->nama_kelas); ?></td>
                <td class="text-center"><?= html_escape($rk->tahun_ajaran); ?></td>
                <td class="text-center"><?= (int)$rk->laki_laki; ?></td>
                <td class="text-center"><?= (int)$rk->perempuan; ?></td>
                <td class="text-center" style="font-weight: bold;"><?= (int)$rk->jumlah; ?></td>
            </tr>
        <?php 
            endforeach; 
        ?>
            <tr class="footer-row">
                <td colspan="4" class="text-right" style="padding-right: 15px;">TOTAL KESELURUHAN:</td>
                <td class="text-center"><?= $tot_l; ?></td>
                <td class="text-center"><?= $tot_p; ?></td>
                <td class="text-center"><?= $tot_all; ?> Santri</td>
            </tr>
        <?php else: ?>
            <tr><td colspan="7" class="text-center">Belum ada data rombel kelas.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- BAGIAN IV: REKAPITULASI GURU -->
<table>
    <tr>
        <td colspan="2" class="section-header">IV. REKAPITULASI DEWAN GURU / TEUNGKU PENGAJAR</td>
    </tr>
    <tr>
        <td class="label-cell">Total Dewan Guru Aktif</td>
        <td style="font-weight: bold;"><?= (int)$stats['guru_total']; ?> Guru</td>
    </tr>
    <tr>
        <td class="label-cell">Tenaga Guru Berstatus PNS (DPK)</td>
        <td><?= (int)$guru_pns; ?> Orang</td>
    </tr>
    <tr>
        <td class="label-cell">Tenaga Guru Berstatus Non-PNS (Yayasan)</td>
        <td><?= (int)$guru_non_pns; ?> Orang</td>
    </tr>
</table>

</body>
</html>

