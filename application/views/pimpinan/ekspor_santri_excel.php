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
    <x:Name>Data Santri Format Dinas</x:Name>
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
  table { border-collapse: collapse; width: 100%; }
  .title-main { font-size: 14pt; font-weight: bold; color: #064e3b; text-align: left; }
  .title-sub { font-size: 11pt; font-weight: bold; color: #333333; margin-bottom: 10px; }
  .info-meta { font-size: 10pt; color: #555555; }
  th { background-color: #064e3b; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 6px 8px; font-size: 10pt; vertical-align: middle; }
  td { border: 1px solid #cccccc; padding: 5px 7px; font-size: 10pt; vertical-align: middle; }
  .text-str { mso-number-format: "\@"; text-align: center; }
  .text-center { text-align: center; }
  .text-right { text-align: right; }
  .row-even { background-color: #f9fafb; }
  .footer-row { background-color: #e6f4ea; font-weight: bold; border-top: 2px solid #064e3b; }
</style>
</head>
<body>

<table>
    <tr>
        <td colspan="19" class="title-main"><?= strtoupper(html_escape($profil->nama_dayah ?? 'LPI DAYAH AL-IKHLAS AL-AZIZIYAH')); ?></td>
    </tr>
    <tr>
        <td colspan="19" class="title-sub">FORMAT DATA SANTRI RESMI DINAS PENDIDIKAN DAYAH ACEH</td>
    </tr>
    <tr>
        <td colspan="19" class="info-meta">
            Alamat: Gampong <?= html_escape($profil->gampong ?? 'Sangso'); ?>, Kec. <?= html_escape($profil->kecamatan ?? 'Samalanga'); ?>, Kab. <?= html_escape($profil->kabupaten ?? 'Bireuen'); ?> | Tahun Ajaran: <?= html_escape($tahun_ajaran); ?> | Tanggal Unduh: <?= $tanggal_cetak; ?>
        </td>
    </tr>
    <tr><td colspan="19"></td></tr>
    <thead>
        <tr>
            <th>NO</th>
            <th>NOMOR INDUK (NIS)</th>
            <th>NIK (16 DIGIT)</th>
            <th>NAMA LENGKAP SANTRI</th>
            <th>L/P</th>
            <th>TEMPAT LAHIR</th>
            <th>TANGGAL LAHIR</th>
            <th>NAMA AYAH</th>
            <th>NAMA IBU</th>
            <th>PEKERJAAN ORTU</th>
            <th>GAMPONG/DESA</th>
            <th>KECAMATAN</th>
            <th>KABUPATEN/KOTA</th>
            <th>PROVINSI</th>
            <th>ASAL SEKOLAH</th>
            <th>JENJANG</th>
            <th>ROMBEL / KELAS</th>
            <th>TAHUN MASUK</th>
            <th>STATUS</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($santri)): ?>
            <tr>
                <td colspan="19" class="text-center" style="padding: 20px;">Tidak ada data santri aktif ditemukan.</td>
            </tr>
        <?php else: ?>
            <?php 
            $no = 1; 
            $total_l = 0;
            $total_p = 0;
            foreach ($santri as $s): 
                if ($s->jenis_kelamin === 'L') $total_l++; else $total_p++;
                $bg_class = ($no % 2 === 0) ? 'class="row-even"' : '';
            ?>
                <tr <?= $bg_class; ?>>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-str"><?= html_escape($s->no_induk); ?></td>
                    <td class="text-str"><?= html_escape($s->nik ?: '-'); ?></td>
                    <td style="font-weight: 600;"><?= html_escape($s->nama); ?></td>
                    <td class="text-center"><?= $s->jenis_kelamin === 'L' ? 'L' : 'P'; ?></td>
                    <td><?= html_escape($s->tempat_lahir ?: '-'); ?></td>
                    <td class="text-center"><?= html_escape($s->tanggal_lahir ?: '-'); ?></td>
                    <td><?= html_escape($s->nama_ayah ?: '-'); ?></td>
                    <td><?= html_escape($s->nama_ibu ?: '-'); ?></td>
                    <td><?= html_escape($s->pekerjaan_ayah ?: ($s->pekerjaan_ibu ?: '-')); ?></td>
                    <td><?= html_escape($s->asal_gampong ?: '-'); ?></td>
                    <td><?= html_escape($s->asal_kecamatan ?: '-'); ?></td>
                    <td><?= html_escape($s->asal_kabupaten ?: '-'); ?></td>
                    <td><?= html_escape($s->asal_provinsi ?: 'Aceh'); ?></td>
                    <td><?= html_escape($s->asal_sekolah ?: '-'); ?></td>
                    <td class="text-center"><?= html_escape($s->nama_jenjang ?: '-'); ?></td>
                    <td class="text-center"><?= html_escape($s->nama_kelas ?: '-'); ?></td>
                    <td class="text-center"><?= html_escape($s->tahun_masuk ?: '-'); ?></td>
                    <td class="text-center" style="font-weight: bold; color: <?= $s->status === 'aktif' ? '#047857' : '#b91c1c'; ?>;">
                        <?= strtoupper(html_escape($s->status)); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr class="footer-row">
                <td colspan="4" style="text-align: right; padding-right: 15px;">TOTAL SANTRI AKTIF:</td>
                <td class="text-center"><?= count($santri); ?> Santri (<?= $total_l; ?> L / <?= $total_p; ?> P)</td>
                <td colspan="14"></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>

