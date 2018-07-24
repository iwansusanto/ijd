<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="module-info">
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
        <tbody>
            <?php foreach ($imbajJasa as $i=>$row): ?>
            <tr>
                <td class="cell"><?= $row->nip ?></td>
                <td class="cell"><?= $row->nama_dosen; ?></td>
                <td class="cell"><?= $row->nama_fakultas; ?></td>
                <td class="cell"><?= $row->nama_dosen_digantikan; ?></td>
                <td class="cell"><?= $row->nama_fakultas_digantikan; ?></td>
                <td class="cell"><?= $row->moduleTahunAjaran->module->nama; ?></td>
                <td class="cell"><?= $row->nama_kelas; ?></td>
                <td class="cell"><?= $row->nama_ruangan; ?></td>
                <td class="cell"><?= $row->tgl_kegiatan; ?></td>
                <td class="cell"><?= $row->jam_mulai; ?></td>
                <td class="cell"><?= $row->jam_selesai; ?></td>
                <td class="cell"><?= $row->nama_peran; ?></td>
                <td class="cell"><?= $row->jumlah_jam_rumus; ?></td>
                <td class="cell"><?= $row->transport; ?></td>
                <td class="cell"><?= $row->honor; ?></td>
                <td class="cell"><?= $row->keterangan; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>