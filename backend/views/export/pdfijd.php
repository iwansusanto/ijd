<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$total_transport = 0;
$total_honor = 0;

?>

<div class="module-info">
    <div class="wrapper-left-70">
        <ul class="list-header">
            <li>
                <div class="list-left">Modul</div>
                <div class="list-right">:&nbsp;&nbsp;<?= $moduleTahunAjaran->module->nama; ?></div>
            </li>
            <li>
                <div class="list-left">Jumlah SKS</div>
                <div class="list-right">:&nbsp;&nbsp;<?= $moduleTahunAjaran->jumlah_sks; ?></div>
            </li>
            <li>
                <div class="list-left">Jumlah menit per SKS</div>
                <div class="list-right">:&nbsp;&nbsp;<?= $moduleTahunAjaran->jumlah_menit_per_sks; ?> menit</div>
            </li>
            <li>
                <div class="list-left">Bulan</div>
                <div class="list-right">:&nbsp;&nbsp;<?= Yii::$app->is->bulan((int)Yii::$app->is->bulanhitung($transaksi->bulan_tahun)); ?></div>
            </li>
            <li>
                <div class="list-left">Tahun</div>
                <div class="list-right">:&nbsp;&nbsp;<?= Yii::$app->is->tahunhitung($transaksi->bulan_tahun) ?></div>
            </li>
        </ul>
    </div>
    
    <div class="wrapper-left-30">
        <table class="table-peran">
            <thead>
                <tr>
                    <th class="cell-peran">Peran</th>
                    <th class="cell-peran right">Honor</th>
                    <th class="cell-peran">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peranHitung as $x=>$data): ?>
                <tr>
                    <td class="cell-peran"><?= $data->peran->nama; ?></td>
                    <td class="cell-peran right"><?= Yii::$app->formatter->asRoundedCurrency($data->honor_menit_hitung, 'Rp.'); ?></td>
                    <td class="cell-peran">per jam</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th class="cell">NIP</th>
                <th class="cell">Nama</th>
                <th class="cell">Induk Fak</th>
                <th class="cell">Nama Dosen Yang Digantikan</th>
                <th class="cell">Induk Fak Dosen Yang Digantikan</th>
                <th class="cell">Modul</th>
                <th class="cell">Nama Kelas</th>
                <th class="cell">Ruang</th>
                <th class="cell">Tgl_Kegiatan</th>
                <th class="cell">Jam Mulai</th>
                <th class="cell">Jam Selesai</th>
                <th class="cell">Peran</th>
                <th class="cell">Jumlah Jam Rumus</th>
                <th class="cell">Transport</th>
                <th class="cell">Honor Diterima</th>
                <th class="cell">Keterangan</th>
            </tr>
        </thead>
        <?php  ?>
        <tbody>
            <?php foreach ($imbajJasa as $i=>$row): ?>
            <?php $total_transport += $row->transport; ?>
            <?php $total_honor += $row->honor; ?>
            <tr>
                <td class="cell"><?= $row->nip ?></td>
                <td class="cell"><?= $row->nama_dosen; ?></td>
                <td class="cell"><?= $row->nama_fakultas; ?></td>
                <td class="cell"><?= $row->nama_dosen_digantikan; ?></td>
                <td class="cell"><?= $row->nama_fakultas_digantikan; ?></td>
                <td class="cell"><?= $row->moduleTahunAjaran->module->nama; ?></td>
                <td class="cell"><?= $row->nama_kelas; ?></td>
                <td class="cell"><?= $row->nama_ruangan; ?></td>
                <td class="cell"><?= Yii::$app->formatter->asDate($row->tgl_kegiatan); ?></td>
                <td class="cell"><?= $row->jam_mulai; ?></td>
                <td class="cell"><?= $row->jam_selesai; ?></td>
                <td class="cell"><?= $row->nama_peran; ?></td>
                <td class="cell"><?= $row->jumlah_jam_rumus; ?></td>
                <td class="cell right"><?= Yii::$app->formatter->asRoundedCurrency($row->transport, 'Rp.'); ?></td>
                <td class="cell right"><?= Yii::$app->formatter->asRoundedCurrency($row->honor, 'Rp.'); ?></td>
                <td class="cell"><?= $row->keterangan; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="13">Total</td>
                <td class="cell right"><?= Yii::$app->formatter->asRoundedCurrency($total_transport, 'Rp.'); ?></td>
                <td class="cell right"><?= Yii::$app->formatter->asRoundedCurrency($total_honor, 'Rp.'); ?></td>
                <td class="cell"></td>
            </tr>
        </tfoot>
    </table>
    
    <ul class="list-note">
            <li class="nb">Catatan yang harus diperhatikan</li>
        <?php foreach ($noteIjd as $i=>$note): ?>
            <li><?= ($i+1).'.&nbsp;'.$note->title; ?></li>
        <?php endforeach; ?>
    </ul>
    
    <div class="wrapper-persetujuan">
        <div>Depok, <?= Yii::$app->formatter->asDate(date('Y-m-d')) ?></div>
        <br/>
        <div>Menyetujui</div>
        <div>Koordinator</div>
    </div>
        
</div>