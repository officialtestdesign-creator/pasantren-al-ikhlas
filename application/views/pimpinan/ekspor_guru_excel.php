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
    <x:Name>EDATUDA Dewan Guru</x:Name>
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
  .title-main { font-size: 14pt; font-weight: bold; color: #1e3a8a; text-align: left; }
  .title-sub { font-size: 11pt; font-weight: bold; color: #333333; margin-bottom: 10px; }
  .info-meta { font-size: 10pt; color: #555555; }
  th { background-color: #1e3a8a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #000000; padding: 6px 8px; font-size: 10pt; vertical-align: middle; }
  td { border: 1px solid #cccccc; padding: 5px 7px; font-size: 10pt; vertical-align: middle; }
  .text-str { mso-number-format: "\@"; text-align: center; }
  .text-center { text-align: center; }
  .text-right { text-align: right; }
  .row-even { background-color: #f8fafc; }
  .footer-row { background-color: #e0e7ff; font-weight: bold; border-top: 2px solid #1e3a8a; }
</style>
</head>
<body>

<table>
    <tr>
        <td colspan="18" class="title-main"><?= strtoupper(html_escape($profil->nama_dayah ?? 'LPI DAYAH AL-IKHLAS AL-AZIZIYAH')); ?></td>
    </tr>
    <tr>
        <td colspan="18" class="title-sub">REKAPITULASI RESMI DEWAN GURU / TENAGA PENDIDIK FORMAT EDATUDA DINAS PENDIDIKAN DAYAH</td>
    </tr>
    <tr>
        <td colspan="18" class="info-meta">
            Alamat: Gampong <?= html_escape($profil->gampong ?? 'Sangso'); ?>, Kec. <?= html_escape($profil->kecamatan ?? 'Samalanga'); ?>, Kab. <?= html_escape($profil->kabupaten ?? 'Bireuen'); ?> | Tanggal Unduh: <?= $tanggal_cetak; ?>
        </td>
    </tr>
    <tr><td colspan="18"></td></tr>
    <thead>
        <tr>
            <th>NO</th>
            <th>NIG (NO. INDUK GURU)</th>
            <th>NIK (16 DIGIT)</th>
            <th>NAMA LENGKAP & GELAR</th>
            <th>L/P</th>
            <th>TEMPAT LAHIR</th>
            <th>TANGGAL LAHIR</th>
            <th>PENDIDIKAN TERAKHIR</th>
            <th>STATUS PNS</th>
            <th>STATUS KEPEGAWAIAN</th>
            <th>BIDANG STUDI / KITAB KUNING DIASUH</th>
            <th>KABUPATEN ASAL</th>
            <th>KECAMATAN ASAL</th>
            <th>DESA/GAMPONG ASAL</th>
            <th>ALAMAT DOMISILI</th>
            <th>NO. HP / WHATSAPP</th>
            <th>EMAIL</th>
            <th>KEAKTIFAN</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($guru)): ?>
            <tr>
                <td colspan="18" class="text-center" style="padding: 20px;">Tidak ada data dewan guru ditemukan.</td>
            </tr>
        <?php else: ?>
            <?php 
            $no = 1; 
            $pns = 0;
            $non_pns = 0;
            foreach ($guru as $g): 
                if ($g->status_pns === 'PNS') $pns++; else $non_pns++;
                $bg_class = ($no % 2 === 0) ? 'class="row-even"' : '';
            ?>
                <tr <?= $bg_class; ?>>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-str"><?= html_escape($g->no_induk); ?></td>
                    <td class="text-str"><?= html_escape($g->nik ?: '-'); ?></td>
                    <td style="font-weight: 600;"><?= html_escape($g->nama); ?></td>
                    <td class="text-center"><?= $g->jenis_kelamin === 'L' ? 'L' : 'P'; ?></td>
                    <td><?= html_escape($g->tempat_lahir ?: '-'); ?></td>
                    <td class="text-center"><?= html_escape($g->tanggal_lahir ?: '-'); ?></td>
                    <td class="text-center"><?= html_escape($g->pendidikan_terakhir ?: '-'); ?></td>
                    <td class="text-center" style="font-weight: bold;"><?= html_escape($g->status_pns); ?></td>
                    <td class="text-center"><?= html_escape($g->status_tetap); ?></td>
                    <td><?= html_escape($g->mata_pelajaran ?: '-'); ?></td>
                    <td><?= html_escape($g->asal_kabupaten ?: '-'); ?></td>
                    <td><?= html_escape($g->asal_kecamatan ?: '-'); ?></td>
                    <td><?= html_escape($g->asal_desa ?: '-'); ?></td>
                    <td><?= html_escape($g->alamat_domisili ?: '-'); ?></td>
                    <td class="text-str"><?= html_escape($g->no_hp ?: '-'); ?></td>
                    <td><?= html_escape($g->email ?: '-'); ?></td>
                    <td class="text-center" style="font-weight: bold; color: <?= $g->aktif ? '#047857' : '#b91c1c'; ?>;">
                        <?= $g->aktif ? 'AKTIF' : 'TIDAK AKTIF'; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr class="footer-row">
                <td colspan="4" style="text-align: right; padding-right: 15px;">TOTAL DEWAN GURU:</td>
                <td class="text-center"><?= count($guru); ?> Guru (<?= $pns; ?> PNS / <?= $non_pns; ?> Non-PNS)</td>
                <td colspan="13"></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>

