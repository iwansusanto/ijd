<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="header-ijd">
    <div class="blue_1">REKAPITULASI JAM DAN HONOR PENGAJARAN DOSEN</div>
    <div class="green-1">MODUL RUMPUN ILMU KESEHATAN</div>
</div>

<div class="module-info">
    <table class="table-module">
        <tbody>
            <tr>
                <td>Modul</td>
                <td><?= $moduleTahunAjaran->module->nama; ?></td>
            </tr>
            <tr>
                <td>Bulan</td>
                <td><?= Yii::$app->is->bulanhitung($transaksi->bulan_tahun) ?></td>
                <td>Tahun</td>
                <td><?= Yii::$app->is->tahunhitung($transaksi->bulan_tahun) ?></td>
            </tr>
        </tbody>
    </table>
    <table class="table-module">
        <tbody>
            <tr>
                <td class="background-yellow-1">Juml SKS</td>
                <td class="background-yellow-1"><?= $moduleTahunAjaran->jumlah_sks; ?></td>
                <td class="background-yellow-1"></td>
            </tr>
            <?php foreach ($peranHitung as $x=>$peran): ?>
            <tr>
                <td class="background-yellow-1"><?= $peran->peran->nama; ?></td>
                <td class="background-yellow-1">Rp. <?= $peran->honor_menit_hitung; ?></td>
                <td class="background-yellow-1">per jam</td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td class="background-yellow-1">Jumlah Menit Per SKS</td>
                <td class="background-yellow-1"><?= $moduleTahunAjaran->jumlah_menit_per_sks; ?></td>
                <td class="background-yellow-1">menit</td>
            </tr>
        </tbody>
    </table>
</div>